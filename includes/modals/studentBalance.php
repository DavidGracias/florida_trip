<div class="modal fade" id="studentBalance" tabindex="-1" role="dialog" aria-labelledby="studentBalance" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h4 class="modal-title" data-id="">
                    
                </h4>
            </div>
            <div id="studentBalanceModalBody" class="modal-body" data-id="<?php echo $_SESSION["currentStudent"]; ?>">
                <table class='table table-striped table-hover table-responsive' id='studentBalanceTable' style="width:100%">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Payment Type</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function populateStudentBalanceModal(id){
        $.ajax({
           url:"scripts/connection.php?getFrom.php",
           type:"POST",
           data:{
               "table":"students",
               "where":true,
               "studID":id,
           },
           success:function(response){
                var row = response.split("ENDOFROW");
                var cols = row[0].split("\n");
                for(var y = 0; y < cols.length; y++){ //each column
                    var dict=cols[y].split(":::"); //array of length 2
                    if(dict[0] == "fName")
                        $fName = dict[1];
                    if(dict[0] == "lName")
                        $lName = dict[1];
                    if(dict[0] == "balance")
                        $balance = dict[1];
                }
                $("#studentBalance .modal-title").text($fName+" "+$lName+" ($"+$balance+")");
           },
           error:function(){
               
           }
        });
        $.ajax({
            url:"scripts/connection.php?studentBalance.php",
            type:"POST",
            data: {
                studID:id
            },
            success:function(response){
                $("#studentBalanceTable td").remove();
                var arr = response.split("\n");
                for (var i=0; i<arr.length; i++){
                    var info = arr[i].split(":::");
                    switch(info[1]){
                        case "0": info[1]="Cash"; break;
                        case "1": info[1]="Check"; break;
                        case "2": info[1]="Fundraiser"; break;
                        case "3": info[1]="Paypal"; break;
                    }
                    var temp = new Date(Date.parse(info[5].replace('-','/','g')));
                    info[5]=temp;
                    var table = document.getElementById("studentBalanceTable");
                    var row = table.insertRow(i+1);
                    var amount = row.insertCell(0);
                    var paymentType = row.insertCell(1);
                    var transactionDate = row.insertCell(2);
                    amount.innerHTML = info[4];
                    paymentType.innerHTML = info[1];
                    transactionDate.innerHTML = info[5];
                    // var amount = arr[]
                }
            },
            error:function(){
                alert("could not connect to the database");
            }
        });
    }
</script>