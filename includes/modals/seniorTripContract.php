<div class="modal fade color-black" id="seniorTripContractModal" tabindex="-1" role="dialog" aria-labelledby="seniorTripContractModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content padding-4">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h4 class="modal-title">Senior Trip Contract</h4>
            </div>
            <div class="modal-body">
               <h3 class='bold underline-black text-center'>RETURN ALL FORMS WITH THE FIRST PAYMENT</h3>
               <p class="text-center">Plymouth Whitemarsh High School</p>
               
               <h3 class='bold underline-black text-center'>SENIOR CLASS TRIP CONTRACT</h3>
               <?php
               //I just cut trip year because I only use date("Y") once.
                $startDate="";
                $endDate="";
                $result=mysqli_query($conn, "SELECT * from trip WHERE gradYear=".$_SESSION["gradYear"]);
                if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)) {
                    //This is what u meant right David.
                    $startDate=substr($row["floridaStart"], 0, 10);
                    $endDate=substr($row["floridaEnd"], 0, 10);
                }
               ?>
               <p class="tab">The Plymouth Whitemarsh High School Class of <?php echo date("Y"); ?> has been granted permission to take a Senior Class trip to Orlando, Florida on <?php echo $tripYear; ?> through Monday April 8, 2019.  This is a unique opportunity to combine a truly educational experience with an equally enjoyable one and will provide seniors with rich memories for later years.</p>
               <p class="tab">This opportunity comes along with responsibilities, which each participant must be willing to accept. Your signature below indicates that you are in agreement with the contract, that you understand all rules and regulations, and that you realize that the breaking of this contract will result in your being sent home at your own expense. Discuss this contract and all rules and regulations thoroughly with your parents before signing.</p>
               
               <h3 class='bold underline-black text-center'>RULES STUDENTS MUST FOLLOW AFTER SIGNING UP FOR THE TRIP </h3>
               <ol>
                   <li>Students must be passing all courses needed for graduation to participate in the trip.</li>
                   <li>Participation by students in the class trip will be based upon their academic and social performance throughout the year.</li>
                   <li>Students who are absent more than 15% of the total school days prior to the final payment will be removed from the trip pending a hearing by the administration.</li>
               </ol>
               <h3 class='bold underline-black text-center'>RULES STUDENTS MUST FOLLOW WHILE ON THE TRIP </h3>
               <ol>
                   <li>The Colonial School District policy on drug and alcohol possession and use will be in effect for the entire length of the trip. In addition to School District policy, this and all other illegal offenses will be dealt with by local, state, and federal jurisdiction.</li>
                   <li>A student in violation of Rule 1 will be sent home at his/her own expense and will be referred to the Superintendent for possible permanent expulsion.</li>
                   <li>Students will be familiar with and adhere to all time schedules provided on the itinerary or as directed by the chaperones.</li>
                   <li>Students are expected to participate in all scheduled events and to remain with the group during the entire trip.</li>
                   <li>Students will observe common courtesy to each other and to all adults at all times.</li>
                   <li>Smoking is not permitted on the buses or the airplane.</li>
                   <li>Boys are not permitted on the girls’ floor. Girls are not permitted on the boys’ floor.</li>
                   <li>Students participating in the trip MUST be on time for school on Tuesday, April 9.</li>
                   <li>Every effort has been made to provide you with an enjoyable and educational trip. We expect exemplary conduct and behavior.</li>
               </ol>
               
               <h3 class='bold underline-black text-center'>PAYMENT SCHEDULE</h3>
               <p>Students and parents must agree to the following payment schedule:</p>
               <div class="text-center">
                   <ul class="display-inline text-left" style="padding-left: 27.5px">
                       <?php
                       //Adjusts for each year.
                        $result=mysqli_query($conn, "SELECT * from trip WHERE gradYear=".$_SESSION["gradYear"]);
                        while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)) {
                            echo "<li>$".$row["pay1"]." is due on or before ".date("F d, Y", strtotime($row["payDate1"])).".</li>";
                            echo "<li>$".$row["pay2"]." is due on or before ".date("F d, Y", strtotime($row["payDate2"])).".</li>";
                            echo "<li>$".$row["pay3"]." is due on or before ".date("F d, Y", strtotime($row["payDate3"])).".</li>";
                        }
                       ?>
                   </ul>
               </div>
            </div>
            <form class="modal-footer text-left" id="seniorContractForm">
                <h4>
                    Student Affirmation
                </h4>
                <div class="tab padding-3">
                    The initial deposit secures your place on the trip.
                    Initial deposit must be accompanied by this contract.
                    Students will be given the opportunity to raise money for the trip through participation in fundraisers.
                    Payments will be taken at any time on or before the above deadlines.
                    <span class="bold">Cancellations after November 21, 2018 will be subject to penalty fees.</span>
                    Money earned from fundraising will not be refunded.
                </div>
               <div class="row">
                    <div class='form-group col-xs-12 col-md-6'>
                        <label for="studentSig">Student Signature: <span class="fas fa-asterisk color-red"></span></label>
                        <input class="form-control input" required="required" type="text" placeholder="Type Your Name: <?php echo $_SESSION['fName'].' '.$_SESSION['lName']; ?>"/>
                    </div>
                    <div class='form-group col-xs-12 col-md-6'>
                            <label for="studDate">Date: <span class="fas fa-asterisk color-red"></span></label>
                            <input class="form-control input" required="required" type="text" placeholder="Current Date: <?php echo date("m/d/Y");?>" title="Current Date"/>
                    </div>
                </div>
                <div class="col-xs-12" style="height: 5px"></div>
                <div class="form-check-inline padding-2">
                    <label class="display-inline form-check-label pointer" for="studentCheckbox">
                        <input class="display-inline form-check-input pointer" required="required" type="checkbox" name="studentCheckbox" id="studentCheckbox">
                        I understand that checking this box, in conjunction with typing my name (first last) and date above, constitutes a legal signature confirming that I acknowledge and warrant the truthfulness of the information provided in this document.
                    </label>
                </div>
                
                <hr/>
                <div class="col-xs-12" style="height: 30px"></div>
                
                
                <h4>
                    Parent / Guardian Affirmation
                </h4>
                <div class="text-left tab">
                    As parent/guardian of the above student, I have discussed the above rules and regulations with my child.
                    He/she assures me that he/she will comply with all contract provisions.
                    I fully understand and agree that if my child does not comply with the
                    contract we will be financially responsible for his/her return flight home.
                    I give my child permission to participate in the class trip.
                 </div>
                <div class="col-xs-12" style="height: 5px"></div>
                <div class="row">
                    <div class='form-group col-xs-12 col-md-6'>
                        <label for="parentSig">Parent Signature: <span class="fas fa-asterisk color-red"></span></label>
                        <input class="form-control input" required="required" type="text" placeholder="Type Your Name (Parent/Guardian)"/>
                    </div>
                    <div class='form-group col-xs-12 col-md-6'>
                        <label for="parentDate">Date: <span class="fas fa-asterisk color-red"></span></label>
                        <input class="form-control input" required="required" type="text" placeholder="Current Date <?php echo date("m/d/Y");?>" title="Current Date"/>
                    </div>
                </div>
                <div class="form-check-inline">
                        <label class="display-inline form-check-label pointer" for="parentCheckbox">
                            <input class="display-inline form-check-input pointer" required="required" type="checkbox" id="parentCheckbox" name="parentCheckbox">
                            I understand that checking this box, in conjunction with typing my name (first last) and date above, constitutes a legal signature confirming that I acknowledge and warrant the truthfulness of the information provided in this document.
                        </label>
                    </div>
                <div class="clear" style="height: 15px;"></div>
                <div class="btn btn-danger pull-left" data-dismiss="modal">Cancel</div>
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#seniorTripContractModal input[title='Current Date']").focus(function(){
            var color=$(this).parent().prev().find("input").css("background-color");
            if( $(this).parent().prev().find("input").val() == "" )
                return;
            var date=new Date();
            var today=date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear();
            if($(this).val() == "")
                $(this).animate({ backgroundColor: "#A3FFA3"}).animate({ backgroundColor: "#FFFFFF"});
            $(this).val(today);
        });
        
        $("#seniorContractForm").submit(function(){
            $.ajax({
                url: "scripts/connection.php?updateValues.php",
                type: "POST",
                data:{
                    "table": "students",
                    "where-studID": "<?php echo $_SESSION['id']; ?>",
                    "seniorTripContract": "1",
                },
            });
            // $("#seniorTripContractModal").modal('hide');
            // return false;
        });
    });
</script>