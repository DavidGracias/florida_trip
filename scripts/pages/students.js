$(document).ready(function() {
    $(".table-students button .fa-info-circle").parent().click(function() {
        $("#medicalInfoModal [data-type='save']").click();
        var id=$(this).parent().parent().attr("title");
        var href = $("#medicalPDFLink").attr("href");
        if(href.lastIndexOf("&") > 0)
            href = href.substring(href, href.lastIndexOf("&"));
        $("#medicalPDFLink").attr("href", href+"&studID="+id);
        $("#medicalInfoModal [where-studID]").attr("where-studID", id);
        $.ajax({
            url: "scripts/connection.php?getFrom.php",
            type: "POST",
            data: {
                table: "form",
                where: true,
                studID: id,
            },
            success: function(response) {
                if (response == ""){
                    $("#medicalInfoModal .alert-danger").css("display", "block");
                    $("#medicalInfoModal [data-table='form'][data-type='editable']").attr("data-type", "");
                }
                else{
                    $("#medicalInfoModal .alert-danger").css("display", "none");
                    $("#medicalInfoModal [data-table='form'][data-type='']").attr("data-type", "editable");
                }
                    
                var studArr=response.split("\n");
                for (var x=0; x < studArr.length; x++) {
                    var dict=studArr[x].split(":::");
                    if (dict.length == 2 && $("#" + dict[0]).length == 1)
                        $("#medicalInfoModal #" + dict[0]).text(dict[1]);
                    //else alert(dict[0]);
                }
                $.ajax({
                    url: "scripts/connection.php?getFrom.php",
                    type: "POST",
                    data: {
                        table: "students",
                        where: true,
                        studID: id,
                    },
                    success: function(response) {
                        var studArr=response.split("\n");
                        for (var x=0; x < studArr.length; x++) {
                            var dict=studArr[x].split(":::");
                            if (dict.length == 2 && $("#" + dict[0]).length == 1) {
                                $("#medicalInfoModal #" + dict[0]).text(dict[1]);
                            }
                        }

                        //dates
                        $("#medicalInfoModal #birthday, #medicalInfoModal #tetanus").each(function() {
                            var bday=$(this).text().split("-");
                            if (bday.length == 3)
                                $(this).text(parseInt(bday[1], 10) + 1 + "/" + bday[2] + "/" + bday[0]);
                        });

                        //phones
                        $("#medicalInfoModal [id*='phone'], #medicalInfoModal [id*='Phone']").each(function() {
                            var phone=$(this).text();
                            if (phone.length == 10)
                                $(this).text(phone.substr(0, 3) + "-" + phone.substr(3, 3) + "-" + phone.substr(6));
                        });

                        //booleans
                        $("#medicalInfoModal #chronic, #medicalInfoModal #counterDrugs").each(function() {
                            if (parseInt($(this).text(), 10) == 0)
                                $(this).text("No");
                            else if (parseInt($(this).text(), 10) == 1)
                                $(this).text("Yes");
                        });

                        //non-required
                        $("#medicalInfoModal #allergies").each(function() {
                            if ($(this).text() == "")
                                $(this).text("--");
                        });
                    },
                });
            },
        });
    }); //end of Medical Info Button Click
    
    $(".remindButton").click( function(){
        var subj;
        if($(this).text().split(" ")[$(this).text().split(" ").length -1].toUpperCase() == "PAYMENTS" ){subj = "form";}
        else{ subj = "payment";}
        $(this).next("ul").children().each(function(){
            $.ajax({
                url: "scripts/mailer.php",
                type: "POST",
                data:{
                    id: $(this).attr("dataid"),
                    subject: subj,
                    reciepts: false
                },
                success: function(response){
                    console.log(response);
                },
                error: function(response){
                    alert("Error Sending Emails");
                }
            });
        });
            
    });
    
});// end of doc.ready

const JumpTo = function(letter){
    if($('#nav').offset().top - $("#students").offset().top < 0)
        scroll($("#students").children().first());
    $("#container").dequeue()
    .animate({
        scrollTop: letter.offset().top - letter.parent().prev().height() - $("#container").offset().top + $('#container').scrollTop(),
    }, 1000);
}