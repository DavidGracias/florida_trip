function scroll(element){
    if(element.offset()===undefined)
        return;
    
    var elements=[ $("canvas")];
    for(var x=0; x < elements.length; x++)
        elements[x].hide();
    
    var offset=element.offset().top;
    
    for(var i=0; i < elements.length; i++)
        elements[i].show();
    
    var height=$('#nav').outerHeight();
    $('html, body').animate({
        scrollTop:  offset - height,
    }, 1000);
}
    
function clearLabelled(element){
    $('[data-type="form-validation-error"]').addClass("display-none");
    element.find("input[type='radio']").each(function(){
        $(this).prop('checked', false).animate({ backgroundColor: "#FFFFFF"});
    });
    element.find("[for]").each(function(){
        $("#"+ $(this).attr("for")).text("").val("").animate({ backgroundColor: "#FFFFFF"});
    });
}

function slideNext(element, element2, func){
    if(element !==undefined && element2 !==undefined && element.queue().length == 0 && element2.queue().length == 0){
        var fn=window[func];
        if( typeof fn !=='function' || (func.indexOf("_Delay") == -1 && func.indexOf("_Hurry") == -1) )
            element2.slideToggle();
        if(typeof fn==='function')
            if(func.indexOf("_Delay") > -1)
                element2.slideToggle(function(){
                    fn(element, element2);
                });
            else{
                fn(element, element2);
                if(func.indexOf("_Hurry") > -1)
                    element2.slideToggle();
            }
        
        if(element.find('.fas').hasClass("fa-angle-double-up"))
            element.find('.fa-angle-double-up').removeClass("fa-angle-double-up").addClass("fa-angle-double-down");
        else if(element.find('.fas').hasClass("fa-angle-double-down"))
            element.find('.fa-angle-double-down').removeClass("fa-angle-double-down").addClass("fa-angle-double-up");
    }
}

function splitCamelCase(str){
    var output="";
    for(var x=0; x < str.length; x++)
        if(str.charCodeAt(x) == str.toLowerCase().charCodeAt(x))
            output+=str.charAt(x);
        else output+=" "+str.charAt(x).toLowerCase();;
    output=output.split(' ');
    for (var i=0; i < output.length; i++)
            output[i]=output[i].charAt(0).toUpperCase() + output[i].slice(1); 
    return output.join(' ');
}
$(document).ready(function(){
    $('.stickyHeader').each(function(){//initialize floatThead
        $(this).floatThead({
            scrollContainer: true,
        });
    });
    $('[data-toggle="popover"]').popover();
    $(".datepicker").datepicker({
            showAnim: "blind",
            // maxDate: "+0M +0D",
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy/mm/dd",
        });
    $(".datepicker").change(function(){
        $(this).blur();
    });
    $(".btn-danger").hover(
        function(){
            if ($(this).children().hasClass("fa-times")){
                $(this).children().first().clearQueue();
                $(this).children().first().animate(
                    { deg: 90 },
                { duration: 500,
                step: function(now) {
                    $(this).css({ transform: 'rotate(' + now + 'deg)' });
                }     
            });
            }
        }, function(){
            if ($(this).children().hasClass("fa-times")){
                $(this).children().first().clearQueue();
                $(this).children().first().animate(
                    { deg: 0 },
                { duration: 500,
                step: function(now) {
                    $(this).css({ transform: 'rotate(' + now + 'deg)' });
                }     
            });
            }
        });
    $(function(){
        if( $("#coaster").offset().top - window.scrollY <= 0)
            $('#nav').addClass("nav-fade-in");
        $('[id]').each(function(){
            var ids = $('[id="'+this.id+'"]');
            if(ids.length>1 && ids[0]==this)
                console.warn('Multiple IDs #'+this.id);
        });
    });
    
    
    var isFadedIn = $(window).scrollTop() - $("#welcomeText").offset().top <= 0;
    $(document, "body", window).scroll(function(){
        var topOfPage = $(this).scrollTop();
        //nav
        if(
            topOfPage+$("#navLinks").height() < $("#coaster").offset().top &&
            $(".navbar-brand").height() < $("#coaster").offset().top
        )
            $('#nav').dequeue().removeClass("nav-fade-in", 250);
        else
            $('#nav').dequeue().addClass("nav-fade-in", 500);
    });
    
    $(".modal .fa-times").parent().click(function(){
        var parent=$(this);
        
        while( !parent.hasClass("modal") )
            parent=parent.parent();
        
        parent.find(".active").each(function(){
            $(this).removeClass("active");
            $(this).parent().children().first().addClass("active");
            if($(this).parent().children().first().hasClass("display-none")){
                $(this).parent().children().first().removeClass("display-none");
                $(this).addClass("display-none");
            }
        });
        
        clearLabelled(parent);
    });
    
    $(document).on("click", "[data-type='slideable']", function(e){
        var parent=$(this);
        var x=$(this).attr("data-parent");
        for(x; x > 0; x--)
            parent=parent.parent();
        var target=parent.find($(this).attr("data-target"));
        
        if( e.target.classList.contains("fa-edit") && target.css("display") == "block")
            return;
        if( e.target.classList.contains("fa-save") || e.target.classList.contains("fa-times"))
            return;
        
        slideNext($(this), target, $(this).attr("data-function"));
    });
    
    $(document).on("click", ":has(>.fa-angle-double-up), :has(>.fa-angle-double-down)", function(e){
        if($(this).attr('slideable')==="false")
            return;
        if( e.target.classList.contains("fa-edit") && $(this).find(".fa-angle-double-up").length > 0)
            return;
        if( e.target.classList.contains("fa-save") || e.target.classList.contains("fa-times") || e.target.tagName == "TEXTAREA")// && $(this).find(".fa-angle-double-down").length > 0)
            return;
        if( e.target.tagName == "A" || e.target.classList.contains("fa-envelope"))
            return;
        
        var element2=$(this);
        
        if($(this).attr("data-target") !==undefined)
            var element2=$($(this).attr("data-target"));
            
        else if( $(this).find(".fa-angle-double-up, .fa-angle-double-down").attr("data-target") !==undefined )
            var element2=$($(this).find(".fa-angle-double-up, .fa-angle-double-down").attr("data-target"));
            
        else{
            while( !element2.next().length )
                element2=element2.parent();
            element2=element2.next();
        }
        slideNext($(this), element2, $(this).attr("data-function"));
    });
});