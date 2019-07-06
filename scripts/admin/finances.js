$(document).ready(function(){
    /* TRANSACTIONS */
    $("#newTransactionModal").on("show.bs.modal", function(){
        clearTransactionModal();
    });
    $("#newTransactionModal select").change(function(){
        $(this).removeClass("color-blue")
        var parent=$(this).parent().next();
        var input=parent.find(".input").first();
        var addon=parent.find(".input-group-addon").eq(0);
        var addon2=parent.find(".input-group-addon").eq(1);
        switch( parseInt($(this).val(), 10) ){
            case 1:
                addon.text("Check Number");
                addon2.text("#")
                input.attr("placeholder", "Ex: 320");
                break;
            case 2:
                addon.text("Fundraiser");
                addon2.text("");
                input.attr("placeholder", "Search for fundraiser...");
                break;
            case 3:
                addon.text("Account Name");
                addon2.text("@")
                input.attr("placeholder", "username");
                break;
            default:
                addon.text("");
                addon2.text("");
                input.attr("placeholder", "");
        }
        input.val("");
        parent.dequeue();
        if(addon.text() == "")
            parent.slideUp();
        else
            parent.slideDown();
        if(addon2.text() == "")
            addon2.addClass("display-none");
        else
            addon2.removeClass("display-none");
    });
    
    $("#newTransactionModal .btn-success").click(function(){
        var dataArr={table: "transactions"};
        var valid=true;
        $.extend(dataArr, $("#newTransactionModal form").serializeArray().reduce(function(obj, item) {
            if(
                ( item.name !="typeID" && item.value == "" ) || 
                ( item.name == "typeID" && item.value == "" && $("#newTransactionModal [name='type']").val() !="0")
            ){
                $("#newTransactionModal [name='"+item.name+"']").dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                valid=false;
            }
            else if(item.name == "dateTime"){
                item.value = item.value.split("/").join("-");
                valid = valid && !isNaN(new Date( item.value ));
                if(isNaN(new Date( item.value )))
                    $("#newTransactionModal [name='"+item.name+"']").dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"}).val("");
            }
            else if(item.name == "amount")
                item.value = Math.ceil(item.value * 100) / 100;
            obj[item.name] = item.value;
            return obj;
        }, {}) );
        
        if(!valid)
            return
        $.ajax({
                url: "scripts/connection.php?getFrom.php",
                type: "POST",
                data: {
                    table: "students",
                    where: true,
                    studID: dataArr["studID"],
                },
                success: function(response){
                    var row=response.split("ENDOFROW");
                    var cols=row[0].split("\n");
                    for(var y=0; y < cols.length; y++){ //each column
                        var dict=cols[y].split(":::"); //array of length 2
                        if(dict[0] == "gradYear")
                            dataArr[dict[0]]=dict[1];
                    }
                    if(dataArr["gradYear"] !== undefined){
                        $.ajax({
                            url: "scripts/connection.php?insertInto.php",
                            type: "POST",
                            data: dataArr
                            // success:function(){
                            //     $sr = $('<tr></tr>'); 
                            //     $td = $('<td></td>');
                            //     $sr.append($td.text(dataArr['name']));
                            //     $sr.append();
                                
                            //     $('#transactionsTable').append($sr); 
                            // },
                        });
                        $("#transactionSuccessModal").dequeue().fadeIn().delay(2000).fadeOut();
                        clearTransactionModal();
                    }
                    else
                        $("#transactionDangerModal").dequeue().fadeIn().delay(2000).fadeOut();
                }
            });
        
    });
    $("#newTransactionModal .btn-danger").click(function(){
        clearTransactionModal();
    });
    
    /* FUNDRAISERS */
    $(".seeMoreContainer").click(function() {
        $("#changeFund").removeClass("display-none");
        $(".addingFund").addClass("display-none")
    });
    
    $(document).on("click","#newFundContainer", function(){
        SeeMore($(document))
        $("#changeFund").addClass("display-none");
        $(".addingFund").removeClass("display-none");
        $("#fundraisers #Finances-SeeMore").dequeue();
        $("#fundraisers #Finances-SeeMore").slideUp();
        $("#fundraisers #Finances-SeeMore").slideDown();
        var i=0;
        $("#fundraisers #Finances-SeeMore [data-field]").each(function(){
            var suggestedHeight = 19 + 12;
            
            if(i == 0)
                suggestedHeight=45;
            else if(i == 1) suggestedHeight=75;
            
            
            var textbox = $("<textarea></textarea>")
                .css("min-width", $(this).width())
                .css("min-height", $(this).height())
                .css("height", suggestedHeight+"px")
                .css("font-size", (i == 0)? "1.45em" : ".975em")
                .css("display", "inline-block")
                .addClass("form-control");
            let input = $('<input/>')
                .css("min-width", $(this).width())
                .css("min-height", $(this).height())
                .css("height", suggestedHeight+"px")
                .css("font-size", (i == 0)? "1.45em" : ".975em")
                .css("display", "inline-block")
                .attr('type', 'text')
                .addClass('form-control'); 
                
                if($(this).attr("data-field").indexOf("date") != -1){
                    textbox = $('<input />')
                    .addClass('form-control')
                    .attr('data-type', 'date')
                    .attr('type', 'date')
                    .attr('placeholder', formatDate(new Date())); 
                }
                // textbox.datepicker({
                //     showAnim: "blind",
                //     // maxDate: "+0M +0D",
                //     changeMonth: true,
                //     changeYear: true,
                //     dateFormat: "yy/mm/dd",
                // });
                
            $(this).html(textbox);
            
            i++;
        });
    });
    
    $(document).on("click","#submitFund",function(){
        var postData={
            "table": "fundraisers",
            "gradYear" : $(this).attr("data-gradYear")
        };
        var inputs=$("#fundraisers #Finances-SeeMore [data-field]");
        var valid=true;
        for(var i=0; i < inputs.length; i++){
            if(inputs.eq(i).find("textarea").val().length == 0){
                inputs.eq(i).find("textarea").dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                valid=false;
            }
            postData[inputs.eq(i).attr("data-field")]=inputs.eq(i).find("textarea").val();
        }
        //not sure why this is like that, it's done in an odd way. I don't understand how it works, so David, this is all you
        // if(inputs.eq(i).find(".content").attr('data-type').indexOf('date') != -1){
        //         //format date; 
        //         let date = inputs.eq(i).find(".content").val(); 
        //         date = formatDate(date); 
        //         postData[inputs.eq(i).attr("data-field")] = date; 
        //     }else{
        //         postData[inputs.eq(i).attr("data-field")] = inputs.eq(i).find(".content").val();
        //     }
        //this is what I tried, I changed the date things to input elements btw. I think everything but desc should be inputs
        //and then you should loop throguh them with a common class or something using $.each 
        //but idk, just get it to work, before we can migrate. 
        
        if(!valid) return;
        
        // validate phone / dates
        //create system for adding pic ref and pdf link
        postData["picRef"]="0";
        postData["pdfLink"]="";
        
        $.ajax({
            url: "scripts/connection.php?insertInto.php",
            type: "POST",
            data: postData,
            success: function(response){
                document.location.reload();
            },
            error: function(){
                alert("There was a problem adding the fundraiser to the database, please try again.");
            }
        });
    });
    
    $(document).on("click","[data-type].delete", function(){
        var parent=$(this);
        for(var x=$(this).attr("data-parent"); x > 0; x--)
            parent=parent.parent();
            
        var id=$("#fundraisers #Finances-SeeMore [where-id]").first().attr("where-id");
        
        var show=$("<div></div>").append(
            $("#scrollDiv").find("[data-id='"+id+"']").clone().removeClass('display-inline').css("margin", "auto")
        ).append(parent);
        
        if( !confirmDeletion($(this), show) ) return;
        $("#fundraisers #Finances-SeeMore").slideUp();
        $.ajax({
            url:"scripts/connection.php?truncate.php",
            type:"POST",
            data:{
                "table":"fundraisers",
                "where-id": id,
            },
            success:function(response){
                var elem=$("#scrollDiv").find("[data-id='"+id+"']");
                elem.remove();
            }
        });
    });
    
    
    var readURL=function(input) {
        if (input.files && input.files[0]) {
            var reader=new FileReader();

            reader.onload=function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
    
});

function clearTransactionModal(){
    $("#newTransactionModal :input").val("");
    $("#newTransactionModal select").prop("selectedIndex", 0).addClass("color-blue");
    $("#newTransactionModal select").parent().next().dequeue().slideUp();
    var d=new Date();
    var value=d.getFullYear()+"/";
    if(d.getMonth()+1 < 10)
        value +="0";
    value+=(d.getMonth()+1)+"/"+d.getDate();
    $("#newTransactionModal [name='dateTime']").val(value);
}
const formatDate = function(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}