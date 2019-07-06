<div class="modal fade" id="newTransactionModal" tabindex="-1" role="dialog" aria-labelledby="newTransactionModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title display-inline">Enter a New Transcation</h4>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
            </div>
            <form class="modal-body">
                
                <div class="input-group padding-3">
                    <span class="input-group-addon background-blue color-white">Student ID</span>
                    <input id = "transactionID" class="form-control input" type="text" name="studID" placeholder="Search Student..."/>
                </div>
                
                <div class="input-group padding-3">
                    <span class="input-group-addon background-blue color-white">Payment Type</span>
                    <select id = "transactionType" class="color-blue form-control text-center" name="type">
                        <option selected="true" disabled="disabled"> -- Select an Option -- </option>
                        <option value="0" class="color-black">Cash</option>
                        <option value="1" class="color-black">Check</option>
                        <option value="2" class="color-black">Fundraiser</option>
                        <option value="3" class="color-black">PayPal</option>
                    </select>
                </div>
                <div class="display-none">
                    <div class="input-group padding-3">
                        <span class="input-group-addon background-blue color-white"></span>
                        <span class="input-group-addon display-none"></span>
                        <input id = "transactionAddition" class="form-control input" type="text" name="typeID" placeholder=""/>
                    </div>
                </div>
                
                <div class="input-group padding-3">
                    <span class="input-group-addon background-blue color-white">Amount: $</span>
                    <input id = "transactionAmount" class="form-control input" type="number" name="amount" placeholder="Amount"/>
                </div>
                
                <div class="input-group padding-3">
                    <span class="input-group-addon background-blue color-white">Transaction Date</span>
                    <input id = "transactionDate" class="form-control input datepicker" type="text" name="dateTime" placeholder="YYYY/MM/DD"/>
                </div>
            </form>
            
            <div class="modal-footer">
                <div type="button" id = "addTransactionBtn" class="btn btn-success pull-left">Confirm</div>
                <div type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancel</div>
            </div>
        </div>
    </div>
    <div id="transactionSuccessModal" class="padding-5 row display-none" style="position: fixed; top: 0px; width: 100%">
        <div class="bg-success padding-3 border-radius text-success text-center col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-push-1 col-md-push-2 col-lg-push-3 display-block">
            <h4>Transaction <span class="bold">successfully</span> added!</h4>
        </div>
    </div>
    <div id="transactionDangerModal" class="padding-5 row display-none" style="position: fixed; top: 0px; width: 100%">
        <div class="bg-danger padding-3 border-radius text-danger text-center col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-push-1 col-md-push-2 col-lg-push-3 display-block">
            <h4 class="bold">Unable to add student! Please make sure you entered the proper Student ID.</h4>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<script>
    $( function(){
        var availableTags=[
            <?php
            $where="";
            if(intval($_SESSION["gradYear"]) !=9999)
                $where="WHERE `gradYear`=".$_SESSION["gradYear"];
            $result=mysqli_query($conn, "SELECT * FROM `students` ".$where);
            while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                {
                    value: "<?php echo $row["studID"]; ?>",
                    label: "<?php echo ucwords($row["fName"]." ".$row["mName"]." ".$row["lName"]." - '".substr($row["gradYear"], -2)); ?>",
                    desc: "(<?php echo $row["studID"]; ?>)",
                },
                {
                    value: "<?php echo $row["studID"]; ?>",
                    label: "<?php echo $row["studID"]; ?>",
                    desc: "(<?php echo ucwords($row["fName"]." ".$row["mName"]." ".$row["lName"]." - '".substr($row["gradYear"], -2)); ?>)",
                },
            <?php } ?>
        ];
        $("#newTransactionModal input[name='studID']").autocomplete({
            minLength: 3,
            source: availableTags,
            focus: function( event, ui ) {
                $(this).val( ui.item.label );
            return false;
          },
        }).autocomplete( "instance" )._renderItem = function( ul, item ) {
              return $( "<li>" )
                .append( "<div>" + item.label + "<br>" + item.desc + "</div>" )
                .appendTo( ul );
        };
    });
    $(document).ready(function(){
        $("#addTransactionBtn").click(function(){
            var studentID = $("#transactionID").val();
            //alert(studentID);
            var amount = $("#transactionAmount").val();
            $.ajax({
                url:"scripts/connection.php?getFrom.php",
                type:"POST",
                data: {
                    table:"students",
                    where: true,
                    studID: studentID
                },
                success:function(response){
                    var row = response.split("ENDOFROW");
                    var cols = row[0].split("\n");
                    for(var y = 0; y < cols.length; y++){ //each column
                        var dict=cols[y].split(":::"); //array of length 2
                        if(dict[0] == "balance")
                            var balance = dict[1];
                    }
                    var newAmount = parseInt(balance) + parseInt(amount);
                    $.ajax({
                        url: 'scripts/connection.php?updateValues.php',
                        type: 'POST',
                        data:{
                            "table": "students",
                            "where-studID": studentID,
                            "balance" : newAmount,
                        },
                        success:function(response){
                            //alert(newAmount);
                        }
                    });
                },
                error:function(){
                    alert("could not connect to database");
                }
            });
            ///receipts code
            $.ajax({
                url: "scripts/mailer.php",
                type: "POST",
                data:{
                    id: studentID,
                    reciepts: true,
                    amount: amount,
                    type: $("#transactionType").val()
                },
                success: function(response){
                    console.log(response);
                },
                error: function(response){
                    alert("Error Sending Emails");
                }
            });
        });
        
        
        // $("#filterTransactionsDiv .select").click(function(){
        //     if($(this).hasClass("active"))
        //         $(this).removeClass("active");
        //     else{
        //         $(this).addClass("active");
        //         if($(this).find("input").length > 0)
        //             $(this).find("input").focus();
        //     }
        //     filterStudents();
        //     checkLetterHeader();
        // });
        
        // $("#filterStudentsDiv [data-type='clear']").click(function(){
        //     $("#filterStudentsDiv .select:has(input)").removeClass("active");
        //     $("#filterStudentsDiv .select:not(:has(input))").addClass("active");
        //     $("#filterStudentsDiv [data-type='inactive']").removeClass("active");
        //     $("#filterStudentsDiv .select input").val("");
        //     $('.studListing').removeClass('hide');
        // });
    });
</script>