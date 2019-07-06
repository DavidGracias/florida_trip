$(document).ready(function(){
    //tips&tricks resizing
    $(".tip-header").click(function() {
        var chosenElement=$(this);
     //   $("#tips").find(".tip-header").remove(chosenElement).siblings().slideUp();
        //$(chosenElement).slideDown();
        //$("#tips").find(".tip-header").remove(chosenElement).parent().toggleClass("col-md-3 col-md-1");
        //$(chosenElement).parent().toggleClass("col-md-3 col-md-6");

    });
    
    $(document).on("click",".deleteLI", function(){
        $(this).parent().remove();
    });
    $(window).on('resize', function(){
        $(".parkSwitch").each(function(){
            if( $(this).css("top") !="0px" ){
                $(this).css("top", "0px");
                $(this).css("top", Math.abs($(this).offset().top-$("#parkInformationContainer").offset().top + 5/8 *$(this).height())+"px");
                $(".parkInfo h4").css("padding-top",  3/8 *$(this).height()+2.5);
            }
        });
        
    });
    //tips&tricks editing
    $(".fa-edit").click(function() {
        $(this).toggleClass("fa-save");
        $(this).toggleClass("fa-edit");
        var content=($(this).parent().text()).substring(169);
        $(this).siblings("div").remove();
        var node="<textarea class='form-control'>"+content+"</textarea>";
        $(this).parent().append(node);
    });
    
    
    //list image swapping
    $("#male, #female").click(function() {
        var g=$(this).attr("id");
        var p=( $(this).attr("id") !="male")? "male": "female";
        
        if( !$("#"+g).children().last().hasClass("underline") )
            $("#"+g).children().last().addClass("underline");
        if( $("#"+p).children().last().hasClass("underline") )
            $("#"+p).children().last().removeClass("underline");
        
        if( g== "male" ){
            $(this).parent().parent().next().removeClass("display-none");
            $(this).parent().parent().next().next().addClass("display-none");
        }
        else if( g== "female" ){
            $(this).parent().parent().next().next().removeClass("display-none");
            $(this).parent().parent().next().addClass("display-none");
        }
        $("#listPic").attr("src","images/information/packing_guide/"+g+".png");
    });
    
    //park switch stuff
    $(".parkSwitch").click(function(){
        if($(this).css("top") == "0px"){
            $(this).siblings().animate({
                top: "0px"
            }, {duration:200,queue:false});
            $(this).animate({
                top: Math.abs($(this).offset().top-$("#parkInformationContainer").offset().top + 5/8 *$(this).height())+"px",
            }, {duration:200,queue:false});
            $("#parkInformationContainer").css("border-color", $(this).children().first().css("border-color"));
        }
        var counterOffset=3/8 *$(this).height()+2.5;
        var parkFile=$(this).attr("data-location");
        
        $.ajax({
            url: "scripts/connection.php?getFrom.php",
            type: "POST",
            data: {
                table: "parkInfo",
                where: true,
                parkID: parkFile,
            },
            success: function(response){
                if(response == "")
                    return;
                var subjectArr=response.split("ENDOFROW");
                $(".parkInfo [data-subject]").addClass("display-none");
                
                for(var x=0; x < subjectArr.length; x++){
                    var cols=subjectArr[x].split("\n");
                    for(var y=0; y < cols.length; y++){
                        var dict=cols[y].split(":::");
                        if(dict[0] == "id") var id=dict[1];
                        if(dict[0] == "content") var content=dict[1];
                        if(dict[0] == "subjectID") var subject=dict[1];
                    }
                    if(content !=subject && $(".parkInfo [data-subject='"+subject+"']").length > 0){
                        $(".parkInfo [data-subject='"+subject+"']").removeClass("display-none");
                        $(".parkInfo [data-subject='"+subject+"'] span").text(splitCamelCase(subject)+": ");
                        $(".parkInfo [data-subject='"+subject+"'] div").text(content).attr("where-id", id);
                    }
                }
                $(".parkInfo h4").html("").text(splitCamelCase(parkFile)).css("padding-top", counterOffset);
                var faNode=$("<i></i>").css("padding-right", "3px").css("padding-botom", "2px").addClass( $("[data-location='" +parkFile+ "']").attr("data-favicon") ).addClass("fa-lg");
                $(".parkInfo h4").prepend(faNode);
            },
            error: function(){
                alert("could not connect to "+parkFile);
            }
        });
    });
    
    //Packing List Checklist
    $(document).on("click", ".packingItem .fa-square, .packingItem .fa-check-square", function(){
        var isSquare=$(this).hasClass('fa-square');
        var id=$(this).attr('data-id');
        var text=$(this).parent().next().text().toLowerCase();
        
        //in order to check it on the opposite gender's list
        var descID=$(this).parent().parent().parent().parent().attr('id');
        var append=(descID.charAt(descID.length-1) == "0")? "1" : "0";
        descID=descID.substring(0, descID.length-1)+append;
        
        var other=undefined;
        $('#'+descID).find(".packingItem").each(function(){
            if(text== $(this).children().last().text().toLowerCase()){
                other=$(this).children().first().children().first();
                return false;
            }
        });
        if(isSquare){
            if(other !=undefined){
                other.removeClass("fa-square").removeClass("color-yellow");
                other.addClass("fa-check-square").addClass("color-green");
            }
            $(this).removeClass("fa-square").removeClass("color-yellow");
            $(this).addClass("fa-check-square").addClass("color-green");
        }
        else{
            if(other !=undefined){
                other.addClass("fa-square").addClass("color-yellow");
                other.removeClass("fa-check-square").removeClass("color-green");
            }
            $(this).addClass("fa-square").addClass("color-yellow");
            $(this).removeClass("fa-check-square").removeClass("color-green");
        }
        
        $.ajax({
            url: 'scripts/connection.php?getFrom.php',
            type: 'POST',
            data:{
                table: "students",
                where: true,
                studID: id,
            },
            success:function(response){
                var row=response.split("ENDOFROW");
                var cols=row[0].split("\n");
                for(var y=0; y < cols.length; y++){ //each column
                    var target=cols[y].split(":::");
                    if(target[0] == "packingList"){ //new column not yet created
                        target.splice(0, 1);
                        break;
                    }
                }
                if(isSquare)
                    target.push(text);
                else if(target.includes(text))
                    target.splice(target.indexOf(text), 1);
                $.ajax({
                    url: 'scripts/connection.php?updateValues.php',
                    type: 'POST',
                    data:{
                        "table": "students",
                        "where-studID": id,
                        "packingList": target.join(":::").toLowerCase(),
                    },
                });
            },
        });
    });
    
    $(".fa-angle-double-up, .fa-angle-double-down").parent().click(function(){
      slideNext($(this));
    });
    $("#beforeRules, #afterRules").click(function(){
        $(".ruleBtns").css("color","black").css("background-color","white");
        $(this).css("background-color","#C2761F").css("color","white");
        
        $("#rulesContent").children().addClass("display-none");
        $($(this).attr("data-target")).removeClass("display-none");
    });
});//end of doc.ready


