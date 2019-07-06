$(document).ready(function(){
    //STUDENTS.PHP
    $("#filterStudentsDiv .select").click(function(){
        if($(this).hasClass("active"))
            $(this).removeClass("active");
        else{
            $(this).addClass("active");
            if($(this).find("input").length > 0)
                $(this).find("input").focus();
        }
        filter("studListing");
        checkLetterHeader();
    });
    $("#filterStudentsDiv [data-type='clear'], #pay_filter_th [data-type='clear']").click(function(){
        $(".filterGroup .select:has(input)").removeClass("active");
        $(".filterGroup .select:not(:has(input))").addClass("active");
        $(".filterGroup [data-type='inactive']").removeClass("active");
        $(".filterGroup .select input").val("");
        $('.studListing').removeClass('hide');
    });
    
    //FINANCES.PHP
    $(document).on('click', '#pay_filter_th .select', function(){
        if($(this).hasClass("active"))
            $(this).removeClass("active");
        else{
            $(this).addClass("active");
            if($(this).find("input").length > 0)
                $(this).find("input").focus();
        }
        filter('transactionListing'); 
    });
    
    $('#paySearchBar').keyup(function(){
        filter('transactionListing');
        var target = $(this).val().toLowerCase();
        $(".transactionListing").each(function(){
            if($(this).children().first().text().toLowerCase().indexOf(target) == -1)
                //if target is not found
                $(this).addClass("hide");
        });
    });

    
    $(document).on('click', '#pay_filter_th', function(){ //so you can click anywhere in the th
        $(this).children('i').trigger('click');
    }).on('click', '.popover', function(){ // so you can actually use the popover without closing it (it's in the th); 
        return false; 
    });
    
    $('#pay_filter_th i').click(function(e) {  //so the trigger click doesn't click itself
        e.stopPropagation();
  });
    
    
    
    //Ben's filter code:
    $('#searchBar').keyup(function(){
        filterStudents();
        var target = $(this).val().toLowerCase();
        $(".studListing").each(function(){
            if($(this).children('[name=gender]').first().text().toLowerCase().indexOf(target) == -1)
                $(this).addClass("hide");
        });
        checkLetterHeader(); 
    });
    
    checkLetterHeader();
    
});


const filter = function(itemClass, escapeCases) {
    $("."+itemClass).removeClass('hide');
    
    $('.filterGroup').each(function(){  //each filter
        var filter = $(this).attr('name');
        var filterVals = $(this).children('.active').toArray().map(elem => $(elem).attr("value"));
        if(filterVals.length == 0) return; //david added this
        $("."+itemClass).not('.hide').each(function() {  //each student.
            const stud = $(this);
            if(!filterVals.includes( $(this).children("[name='"+filter+"']").attr('value') )){
                $(this).addClass("hide");
            }
        });
    });
    if(escapeCases !== undefined) escapeCases(); 
    
}


const filterStudents = function(){
    $('.studListing').removeClass('hide');
    $('.filterGroup').each(function(){  //each filter
        var filter = $(this).attr('name');
        var filterVals = $(this).children('.active').toArray().map(elem => $(elem).attr("value"));
        if(filterVals.length == 0) return; //david added this
        $('.studListing').not('.hide').each(function() {  //each student.
            const stud = $(this);
            // console.log(filterVals);
            // console.log(filter+" "+$(this).children("[name='"+filter+"']").attr('value'));
            if(!filterVals.includes( $(this).children("[name='"+filter+"']").attr('value') )){
                // console.log("in");
                $(this).addClass("hide");
            }
            // console.log("--------------");
            $('div[name="balance"]').children('div.active').each(function(){
                switch(parseInt($(this).attr('value'))){
                    case -1:  //if their balance is less than value
                        if($(this).children('input').val() && parseInt(stud.children('[name=balance]').attr('value')) > $(this).children('input').val() ){
                            stud.addClass('hide');
                            return; 
                        }
                    case 0:  //if they've completed their payments
                        if(parseInt(stud.children('[name=balance]').attr('value')) < 1950){ //1950 is arbitrary?
                            stud.addClass('hide');
                            return;
                        }
                    case 1: //if their balance is greater than
                        if($(this).children('input').val() && parseInt(stud.children('[name=balance]').attr('value')) < $(this).children('input').val() ){
                            stud.addClass('hide');
                            return;
                        }
                }
            });
        });
        // return false;
    });
    
};
const checkLetterHeader = function(){
    $('.letterHeader').show();
    $('.letterHeader').each(function() {
        if($(this).children().not(".hide").length <= 1){
            $(this).hide();
        } 
    });
};
const filterPayments = function(){
    $('.transactionListing').removeClass('hide');
    
    $('.filterGroup').each(function(){  //each filter
        var filter = $(this).attr('name');
        var filterVals = $(this).children('.active').toArray().map(elem => $(elem).attr("value"));
        if(filterVals.length == 0) return; //david added this
        $('.transactionListing').not('.hide').each(function() {  //each student.
            const stud = $(this);
            if(!filterVals.includes( $(this).children("[name='"+filter+"']").attr('value') )){
                $(this).addClass("hide");
            }
        });
    });

}