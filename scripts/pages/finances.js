$(document).ready(function(){
    $(".progress-bar[data-width]").animate({
        width: $(".progress-bar[data-width]").attr("data-width")+"%"
    }, 2000);
    
    /* FUNDRAISERS */
    $('#right-button, #left-button').click(function() {
        var direction=( $(this).is($("#right-button")) )? "+" : "-" ;
        event.preventDefault();
        $('#scrollDiv').animate({
            scrollLeft: direction+"=210px"
        }, "slow");
    });
    $(".seeMoreContainer").click(function(){
        var element1=$(this);
        $("#fundraisers #Finances-SeeMore").dequeue();
        if($("#fundraisers #Finances-SeeMore").css("display") == "block")
            $("#fundraisers #Finances-SeeMore").slideUp("normal", SeeMore(element1))
        else{
            SeeMore(element1);
        }
    });
    
});
function SeeMore(element1){
    var openCurrent=element1.children().first().text() == "See More";
    $(".seeMoreContainer").each(function(){
        $(this).children().first().text("See More");
        $(this).children().last().removeClass("fa-angle-double-up").addClass("fa-angle-double-down");
    });
    if(!openCurrent)
        return;
    element1.children().first().text("See Less");
    element1.children().last().removeClass("fa-angle-double-down").addClass("fa-angle-double-up");
    $.ajax({
        url:"scripts/connection.php?getFrom.php",
        type:"POST",
        data: {
            table:"fundraisers",
            where: true,
            id: element1.parent().attr("data-id"),
        },
        success:function(response){
            var row=response.split("ENDOFROW");
            var cols=row[0].split("\n");
            $("#fundraisers #Finances-SeeMore").find('[data-field="contactEmail"]').html("");
            for(var y=0; y < cols.length; y++){ //each column
                var dict=cols[y].split(":::"); //array of length 2
                if(dict[0] == "id")
                    $("#fundraisers #Finances-SeeMore").find('[where-id]').attr('where-id', dict[1]);
                var elem=$("#fundraisers #Finances-SeeMore").find('[data-field="'+dict[0]+'"]');
                if(elem.length == 1){
                    var value=dict[1];
                    if(dict[0].toLowerCase().indexOf("date") > -1)
                        value=new Date(dict[1]).toLocaleDateString("en-US", {year: 'numeric', month: 'long', day: 'numeric'});
                    if(dict[0].toLowerCase().indexOf("email") > -1){
                        elem.attr("href", "mailto:"+value);
                    }
                    elem.html(value);
                }
            }
            
            $("#fundraisers #Finances-SeeMore").find(".content").each(function(){
                var attr=$(this).attr("href");
                if(typeof attr !==typeof undefined && attr !==false){
                    if($(this).attr("href").indexOf("@") == -1)
                        $(this).attr("href", "javascript: void(0)");
                }
                if($(this).is($("#Finances-SeeMore [data-field='pdfLink']"))){
                    if($(this).html().length > 0)
                    $(this).html("<div class='text-center padding-1'><i class='fas fa-link'></i><a class='a color-white' href='files/fundraisers/"+$(this).html()+"' target='_blank'> View Additional<br/>Information Here </a></div>");
                }
                else if($(this).text() == ""){
                    $(this).html("N/A");
                }
                
                
            });
            
            $("#fundraisers #Finances-SeeMore").slideDown();
        },
    });
}