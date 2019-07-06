<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="margin-left: 5px">
                    <i class="far fa-user"></i>
                <?php
                    //-1=parent; 0=student; 1=teacher; 2=sponsor;
                    $user=-1; //parent
                    $append=explode("@", $_SESSION['email'])[1];
                    if($append == "staff.colonialsd.org" || $append == "colonialsd.org"){
                        $result=mysqli_query($conn, "SELECT * FROM `admin` WHERE `email`='{$_SESSION['email']}'");
                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $user=2;
                            echo "New Sponsor - Class of {$row['gradYear']}";
                        }
                        else{
                            $user=1;
                            echo "Teacher";
                        }
                        
                    }
                    else if($append == "student.colonialsd.org"){
                        $user=0;
                        echo "New Student";
                    }
                    else echo "New Parent / Guardian";
                ?>
                </h3>
            </div>
            <form class="modal-body">
                <!-- students -- grad year, middle name (optional), student id, alt email addresses (personal or parent) -->
                <?php
                //student
                if($user == 0){ ?>
                    <div class="padding-5 tab">
                            Welcome to the PWHS Disney Trip Website! You can track your payment status, request your roommates, and stay up-to-date on upcoming
                        deadlines and important dates using this site. In order to ensure an optimal experience and validate your identity, please answer
                        a few short questions.
                    </div>
                    <br/>
                    
                    <label class="col-xs-12 padding-0 input-group" for="studID">
                        <div class="input-group-addon background-blue color-white">
                            <span class="input-group-text">
                                Student ID
                                <span class="fas fa-asterisk"></span>
                            </span>
                        </div>
                        <div class="flex-grow">
                            <input name="studID" class="form-control input" required="required" type="text" placeholder="12345"/>
                        </div>
                    </label>
                    <br/>
                    
                    <div class="col-xs-12 padding-0 input-group">
                        <div class="input-group-addon background-blue color-white padding-3">
                            <span class="input-group-text">
                                Name
                                <span class="fas fa-asterisk"></span>
                            </span>
                        </div>
                        <div class="flex-grow row">
                            <div class="col-xs-4">
                                <input type="text" class="form-control input" name="fName" value="<?php echo $_SESSION["fName"]; ?>" placeholder="First *"/>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" class="form-control input" name="mName" placeholder="Middle"/>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" class="form-control input" name="lName" value="<?php echo $_SESSION["lName"]; ?>" placeholder="Last *"/>
                            </div>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="col-xs-12 padding-0 input-group vertical-align">
                        <span class="input-group-text background-blue color-white padding-3" style="margin-right: 10px; border-top-left-radius: 3px; border-bottom-left-radius: 3px;">
                            Gender
                            <span class="fas fa-asterisk"></span>
                        </span>
                        <div class="flex-grow input-select" name="gender">
                            <div class="select btn gender blue" data-value="0">
                                Male
                            </div>
                            <div class="select btn gender pink" data-value="1">
                                Female
                            </div>
                            <div class="select btn gender yellow" data-value="2">
                                Other
                            </div>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="input-group">
                        <span class="input-group-addon background-blue color-white" style="color: #FFAAAA">
                            Graduation Year
                            <span class="fas fa-asterisk"></span>
                        </span>
                        <select class="background-white color-blue form-control input text-center" name="gradYear">
                            <?php $year=( date('m') < 9 )? date('Y') : date('Y')+1; ?>
                            <option selected="true" disabled="disabled"> -- Select an Option -- </option>
                            <option value="<?php echo $year; ?>">Class of <?php echo $year++; ?> - Current Senior</option>
                            <option value="<?php echo $year; ?>">Class of <?php echo $year++; ?> - Current Junior</option>
                            <option value="<?php echo $year; ?>">Class of <?php echo $year++; ?> - Current Sophomore</option>
                            <option value="<?php echo $year; ?>">Class of <?php echo $year; ?> - Current Freshman</option>
                        </select>
                    </div>
                    <br/>
                    
                    <div class="input-group">
                        <span class="input-group-addon background-blue color-white">
                            Parent Email(s)
                        </span>
                        <input type="email" class="form-control" name="addEmail-student" placeholder="parent@gmail.com">
                        <span id="addEmailStudent" class="input-group-addon pointer color-blue background-white"><i class="far fa-plus-square"> Add</i></span>
                    </div>
                    <span class="help-block text-center">
                        You may connect your parent's / guardian's email addresses to your account.
                    </span>
                    <div class="content"></div>
                    <script>
                        $(document).ready(function(){
                            $("#addEmailStudent").click(function(){
                                var email=$("#addEmailStudent").prev();
                                if(
                                    email.val().indexOf("@") == -1 ||
                                    email.val().indexOf("colonialsd") > -1
                                )
                                    return;
                                
                                var content=$(this).parent().next().next();
                                
                                var add="<span>";
                                add+="<span class='pointer addedEmail border-bottom border-bottom-red'> "+email.val()+"</span>";
                                add+=", ";
                                add+="</span>";
                                content.append(add);
                                
                                email.val("");
                                email.focus();
                            }); 
                            $(document).on("click", "#newUserModal .addedEmail", function(){
                                $(this).parent().remove();
                            });
                        });
                        function validate(){
                            var json={
                                table: "students"
                            };
                            var isValid=true;
                            var studID=$("#newUserModal form [name='studID']");
                            if(studID.val().length !=5){
                                studID.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else json["studID"]=studID.val();
                                
                            var fName=$("#newUserModal form [name='fName']");
                            if(fName.val().length == 0){
                                fName.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else json["fName"]=fName.val();
                            
                            json["mName"]=$("#newUserModal form [name='mName']").val();
                            
                            var lName=$("#newUserModal form [name='lName']");
                            if(lName.val().length == 0){
                                lName.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else json["lName"]=lName.val();
                            
                            var gender=false;
                            $("#newUserModal [name='gender'] .select").each(function(){
                                gender=gender || $(this).hasClass("active");
                            });
                            if(!gender){
                                $("#newUserModal [name='gender']").dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else json["gender"]=$("#newUserModal [name='gender']").find(".select.active").attr("data-value");
                            
                            var gradYear=$("#newUserModal [name='gradYear']");
                            if( gradYear.prop("selectedIndex") == 0 ){
                                gradYear.prev().dequeue()
                                .removeClass("color-white")
                                .animate({ color: "#FFAAAA"}).animate({ color: "#FFFFFF"})
                                isValid=false;
                            }
                            else json["gradYear"]=gradYear.val();
                            
                            json["altEmail"]="";
                            $("#newUserModal .addedEmail").each(function(){
                                json["altEmail"]+=$(this).text()+":::";
                            });
                            var email=$("#addEmailStudent").prev().val();
                            if(email !="" && email.indexOf("@") > -1 && email.indexOf("colonialsd") == -1)
                                json["altEmail"]+=email;
                                
                            if(isValid)
                                return json;
                            return isValid;
                        }
                    </script>
                <?php }
                //teacher
                else if($user == 1){ ?>
                    <div class="padding-5 text-center">
                        Welcome to the PWHS Disney Trip Website!
                        <br/><br/>
                        Unfortunately, we do not currently have content which relates to teachers, and therefore have restricted teacher access to the website.
                        <br/><br/>
                        <span class="bold">If you are a chaperone, contact an admin and ask them to add you to the list of chaperones!</span>
                    </div>
                <?php }
                //sponsor
                // are you a class sponsor? what is your graduating class? classroom? middle name??
                else if($user == 2){ ?>
                    <div class="padding-5 text-center">
                        It looks like you need to add some information regarding your specific trip.
                        <br/>
                        <span class='bold'>(approximate dates if necessary, you will be able to make changes in the future)</span>
                        <br/><br/>
                        
                        <h2 class="text-left">Profile</h2>
                        <div class="padding-0 input-group vertical-align flex-nowrap">
                            <span class="input-group-text background-blue color-white padding-2" style="border-top-left-radius: 3px; border-bottom-left-radius: 3px;">
                                Email
                            </span>
                            <div class="flex-grow input-group-addon background-white">
                                <?php echo $_SESSION["email"]; ?>
                            </div>
                        </div>
                        <br/>
                        <div class="row" style="padding-left: 3px">
                            <div class="col-xs-12 col-sm-4 padding-3 input-group pull-left">
                                <div class="input-group-addon background-blue color-white padding-3">
                                    <span class="input-group-text">
                                        Classroom
                                        <span class="fas fa-asterisk"></span>
                                    </span>
                                </div>
                                <input type="text" class="form-control input" name="classroom" value="<?php echo $row['classroom']; ?>" placeholder="X##"/>
                            </div>
                            <div class="clear visible-xs" style="height: 20px"></div>
                             <!--visible-md-->
                            
                            <div class="col-xs-12 col-sm-8 padding-3 input-group pull-left">
                                <div class="input-group-addon background-blue color-white padding-3">
                                    <span class="input-group-text">
                                        Phone
                                        <span class="fas fa-asterisk"></span>
                                    </span>
                                </div>
                                <input type="text" class="form-control input" name="phone" value="<?php echo $row['phone']; ?>" placeholder="610-825-1500 x 0000"/>
                            </div>
                        </div>
                        <br/>
                        
                        <div class="col-xs-12 padding-0 input-group">
                            <div class="input-group-addon background-blue color-white padding-3">
                                <span class="input-group-text" style="padding-right: 10px">
                                    Name
                                    <span class="fas fa-asterisk"></span>
                                </span>
                            </div>
                            <div class="flex-grow row">
                                <div class="col-xs-4 padding-0">
                                    <input type="text" class="form-control input" name="fName" value="<?php echo (strlen($row["fName"]) > 0)? $row["fName"] : $_SESSION["fName"]; ?>" placeholder="First *"/>
                                </div>
                                <div class="col-xs-4 padding-0">
                                    <input type="text" class="form-control input" name="mName" value="<?php echo (strlen($row["mName"]) > 0)? $row["mName"] : $_SESSION["mName"]; ?>" placeholder="Middle"/>
                                </div>
                                <div class="col-xs-4 padding-0">
                                    <input type="text" class="form-control input" name="lName" value="<?php echo (strlen($row["lName"]) > 0)? $row["lName"] : $_SESSION["lName"]; ?>" placeholder="Last *"/>
                                </div>
                            </div>
                        </div>
                        <br/>
                        
                        
                        <!-----------------------------TRIP---------------------->
                        <h2 class="text-left">Trip</h2>
                        <div class="col-xs-12 padding-0 input-group">
                            <div class="input-group-addon background-blue color-white">
                                <span class="input-group-text" style="padding-right: 10px">
                                    Payment 1:
                                </span>
                            </div>
                            <div class="flex-grow row">
                                <div class="col-xs-6 padding-0">
                                    <input type="number" class="input form-control" name="pay1" placeholder="$680"/>
                                </div>
                                <div class="col-xs-6 padding-0">
                                    <input type="text" class="input form-control datepicker" name="payDate1" placeholder="YYYY/MM/DD"/>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xs-12" style="height: 7.5px"></div>
                        
                        <div class="col-xs-12 padding-0 input-group">
                            <div class="input-group-addon background-blue color-white">
                                <span class="input-group-text" style="padding-right: 10px">
                                    Payment 2:
                                </span>
                            </div>
                            <div class="flex-grow row">
                                <div class="col-xs-6 padding-0">
                                    <input type="number" class="input form-control" name="pay2" placeholder="$600"/>
                                </div>
                                <div class="col-xs-6 padding-0">
                                    <input type="text" class="input form-control datepicker" name="payDate2" placeholder="YYYY/MM/DD"/>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xs-12" style="height: 7.5px"></div>
                        
                        <div class="col-xs-12 padding-0 input-group">
                            <div class="input-group-addon background-blue color-white">
                                <span class="input-group-text" style="padding-right: 10px">
                                    Payment 3:
                                </span>
                            </div>
                            <div class="flex-grow row">
                                <div class="col-xs-6 padding-0">
                                    <input type="number" class="input form-control" name="pay3" placeholder="$600"/>
                                </div>
                                <div class="col-xs-6 padding-0">
                                    <input type="text" class="input form-control datepicker" name="payDate3" placeholder="YYYY/MM/DD"/>
                                </div>
                                
                            </div>
                        </div>
                        <br/>
                        
                        <div class="col-xs-12 padding-0 input-group">
                            <div class="input-group-addon background-blue color-white">
                                <span class="input-group-text" style="padding-right: 10px">
                                    Florida Start:
                                </span>
                            </div>
                            <div class="flex-grow row">
                                <div class="col-xs-6 padding-0">
                                    <input type="text" class="input form-control datepicker" name="floridaStart" placeholder="YYYY/MM/DD"/>
                                </div>
                                <div class="col-xs-6 padding-0">
                                    <input type="text" class="input form-control" name="floridaStart-time" placeholder="2:20 PM"/>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xs-12" style="height: 7.5px"></div>
                        <div class="col-xs-12 padding-0 input-group">
                            <div class="col-xs-12 padding-0 input-group">
                            <div class="input-group-addon background-blue color-white">
                                <span class="input-group-text" style="padding-right: 10px">
                                    Florida End:
                                </span>
                            </div>
                            <div class="flex-grow row">
                                <div class="col-xs-6 padding-0">
                                    <input type="text" class="input form-control datepicker" name="floridaEnd" placeholder="YYYY/MM/DD"/>
                                </div>
                                <div class="col-xs-6 padding-0">
                                    <input type="text" class="input form-control" name="floridaEnd-time" placeholder="10:30 PM"/>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xs-12" style="height: 7.5px"></div>
                    </div>
                    </div>
                    <br/>
                    <script>
                        function validate(){
                            var isValid = true;
                            var json={
                                "table": "admin",
                                "where-adminID": "<?php echo $row['adminID']; ?>",
                                "gradYear": "<?php echo $row['gradYear']; ?>",
                            };
                            var classroom=$("#newUserModal form [name='classroom']");
                            if(classroom.val().length == 0){
                                classroom.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else json["classroom"]=classroom.val();
                            
                            var phone=$("#newUserModal form [name='phone']");
                            json["phone"]=phone.val();
                            
                            var fName=$("#newUserModal form [name='fName']");
                            if(fName.val().length == 0){
                                fName.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else json["fName"]=fName.val();
                            
                            json["mName"]=$("#newUserModal form [name='mName']").val();
                            
                            var lName=$("#newUserModal form [name='lName']");
                            if(lName.val().length == 0){
                                lName.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else json["lName"]=lName.val();
                            
                            if(isValid)
                                $.ajax({
                                    type: "POST",
                                    url: "scripts/connection.php?updateValues.php",
                                    data: json,
                                });
                            
                            
                            var tripJSON={
                                table: "trip",
                                gradYear: "<?php echo $row['gradYear']; ?>",
                                displayAssignments: 0,
                            };
                            
                            var pay1=$("#newUserModal form [name='pay1']");
                            if(pay1.val().length == 0){
                                pay1.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else tripJSON["pay1"]=pay1.val();
                            
                            var payDate1=$("#newUserModal form [name='payDate1']");
                            if(payDate1.val().length == 0 || isNaN(new Date().getTime( payDate1.val() ))){
                                payDate1.val("");
                                payDate1.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else tripJSON["payDate1"]=payDate1.val();
                            
                            var pay2=$("#newUserModal form [name='pay2']");
                            if(pay2.val().length == 0){
                                pay2.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else tripJSON["pay2"]=pay2.val();
                            
                            var payDate2=$("#newUserModal form [name='payDate2']");
                            if(payDate2.val().length == 0 || isNaN(new Date().getTime( payDate2.val() ))){
                                payDate2.val("");
                                payDate2.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else tripJSON["payDate2"]=payDate2.val();
                            
                            var pay3=$("#newUserModal form [name='pay3']");
                            if(pay3.val().length == 0){
                                pay3.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else tripJSON["pay3"]=pay3.val();
                            
                            var payDate3=$("#newUserModal form [name='payDate3']");
                            if(payDate3.val().length == 0 || isNaN(new Date().getTime( payDate3.val() ))){
                                payDate3.val("");
                                payDate3.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else tripJSON["payDate3"]=payDate3.val();
                            
                            var floridaStart=$("#newUserModal form [name='floridaStart']");
                            if(floridaStart.val().length == 0 || isNaN(new Date().getTime( floridaStart.val() ))){
                                floridaStart.val("");
                                floridaStart.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else tripJSON["floridaStart"]=floridaStart.val();
                            
                            var value=$("#newUserModal form [name='floridaStart-time']").val().toLowerCase();
                            if(value.length > 0){
                                var valArr=value.split(":");
                                valArr[2]="00";
                                for(var i=0; i < valArr.length; i++)
                                    valArr[i]=parseInt(valArr[i], 10);
                                if(value.indexOf("p") > -1 && valArr[0] !=12)
                                    valArr[0]+=12;
                                for(var x=0; x < valArr.length; x++)
                                    while((valArr[x]+"").length < 2)
                                        valArr[x]="0"+valArr[x];
                                tripJSON["floridaStart"] +=" "+valArr.join(":");
                            }
                            else{
                                $("#newUserModal form [name='floridaStart-time']").dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            
                            var floridaEnd=$("#newUserModal form [name='floridaEnd']");
                            if(floridaEnd.val().length == 0 || isNaN(new Date().getTime( floridaEnd.val() ))){
                                floridaEnd.val("");
                                floridaEnd.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            else tripJSON["floridaEnd"]=floridaEnd.val();
                            
                            var value=$("#newUserModal form [name='floridaEnd-time']").val().toLowerCase();
                            if(value.length > 0){
                                var valArr=value.split(":");
                                valArr[2]="00";
                                for(var i=0; i < valArr.length; i++)
                                    valArr[i]=parseInt(valArr[i], 10);
                                if(value.indexOf("p") > -1 && valArr[0] !=12)
                                    valArr[0]+=12;
                                for(var x=0; x < valArr.length; x++)
                                    while((valArr[x]+"").length < 2)
                                        valArr[x]="0"+valArr[x];
                                tripJSON["floridaEnd"] +=" "+valArr.join(":");
                            }
                            else{
                                $("#newUserModal form [name='floridaEnd-time']").dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid=false;
                            }
                            
                            
                            if(isValid)
                                return tripJSON;
                            return isValid;
                        }
                    </script>
                <?php }
                //parent
                else{ ?>
                    <!--New Parent-->
                    
                    <h4>Link Student to Account</h4>
                    
                    <div class="col-xs-12 padding-0 input-group">
                        <div class="input-group-addon background-blue color-white">
                            <span class="input-group-text">
                                Student ID
                                <span class="fas fa-asterisk"></span>
                            </span>
                        </div>
                        <div class="flex-grow">
                            <input name="studID" class="form-control input" type="text" placeholder="5-Digit Identifier (given by school)"/>
                        </div>
                    </div>
                    <br/>
                    
                    <!--<div class="col-xs-12 padding-0 input-group">-->
                    <!--    <div class="input-group-addon background-blue color-white">-->
                    <!--        <span class="input-group-text" style="padding-right: 12px">-->
                    <!--            Name-->
                    <!--            <span class="fas fa-asterisk"></span>-->
                    <!--        </span>-->
                    <!--    </div>-->
                    <!--    <div class="flex-grow">-->
                    <!--        <div class="col-xs-6 padding-0">-->
                    <!--            <input type="text" class="form-control input" name="fName" placeholder="Student First Name*"/>-->
                    <!--        </div>-->
                    <!--        <div class="col-xs-6 padding-0">-->
                    <!--            <input type="text" class="form-control input" name="lName" placeholder="Student Last Name*"/>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<br/>-->
                    
                    <div class="col-xs-12 padding-0 input-group vertical-align flex-nowrap">
                        <div class="input-group col-xs-6 col-sm-5">
                            <span class="input-group-addon background-blue color-white">
                                Gender
                                <span class="fas fa-asterisk"></span>
                            </span>
                            <select class="form-control text-center" name="gender">
                                <option selected="true" disabled="disabled"> -- Select an Option -- </option>
                                <option value="0" class="color-black">Male</option>
                                <option value="1" class="color-black">Female</option>
                                <option value="2" class="color-black">Other</option>
                            </select>
                        </div>
                        <div class="hidden-xs col-sm-1"></div>
                        <div class="input-group col-xs-6">
                            <span class="input-group-addon background-blue color-white">
                                Graduation Year
                                <span class="fas fa-asterisk"></span>
                            </span>
                            <input class="form-control input" type="text" name="gradYear" placeholder="20XX"/>
                        </div>
                    </div>
                    <br/>
                    
                    <div class="col-xs-12 padding-0 input-group">
                        <div class="input-group-addon background-blue color-white">
                            <span class="input-group-text">
                                Student Email
                                <span class="fas fa-asterisk"></span>
                            </span>
                        </div>
                        <div class="flex-grow">
                            <input name="email" class="form-control input" type="email" placeholder="school.email@student.colonialsd.org"/>
                        </div>
                    </div>
                    
                    <script>
                        function validate(){
                            var json = {};
                            var isValid = true;
                            
                            var studID=$("#newUserModal form [name='studID']");
                            if(studID.val().length != 5){
                                studID.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid = false;
                            }
                            else json["studID"] = studID.val();
                            
                            
                            // var fName=$("#newUserModal form [name='fName']");
                            // if(fName.val().length == 0){
                            //     fName.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                            //     isValid = false;
                            // }
                            // else json["fName"] = fName.val();
                            
                            // var lName=$("#newUserModal form [name='lName']");
                            // if(lName.val().length == 0){
                            //     lName.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                            //     isValid = false;
                            // }
                            // else json["lName"] = lName.val();
                            
                            var gender=$("#newUserModal [name='gender']")
                            if(gender.selectedIndex == 0){
                                $("#newUserModal [name='gender']").dequeue().animate({ color: "#FFBBBB"}).animate({ color: "#FFFFFF"});
                                isValid = false;
                            }
                            else json["gender"] = gender.val();
                            
                            var gradYear=$("#newUserModal form [name='gradYear']");
                            if(gradYear.val().length != 4){
                                gradYear.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid = false;
                            }
                            else json["gradYear"] = gradYear.val();
                            
                            var email=$("#newUserModal form [name='email']");
                            if(email.val().length == 0){
                                email.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid = false;
                            }
                            else json["email"] = email.val();
                            
                            return (isValid)? json : false;
                        }
                        $(document).ready(function(){
                            $("#submitGenInfo").click(function(){
                                var valid=validate();
                                if(valid !== false)
                                    $.ajax({
                                        type: "POST",
                                        url: "scripts/connection.php?newParent.php",
                                        data: valid,
                                        success:function(response){
                                            if(parseInt(response, 10) == 0){
                                                alert("The information provided does not match the information of any student within our database, please verify that your information is correct and try again!")
                                                // no students found
                                                return;
                                            }
                                            else
                                                $.ajax({
                                                    url: "scripts/connection.php?logScript.php",
                                                    success: function(){
                                                        var auth2=gapi.auth2.getAuthInstance();
                                                        var profile=auth2.currentUser.get().getBasicProfile();
                                                        $.ajax({
                                                            url: "scripts/connection.php?logScript.php",
                                                            type: "POST",
                                                            data: profile,
                                                            success: function(response){
                                                                if(response == "Email 404"){
                                                                    $.ajax({
                                                                        url: "scripts/connection.php?logScript.php",
                                                                        type: "POST",
                                                                        data: {
                                                                            U3: profile.getEmail(),
                                                                        },
                                                                    });
                                                                }
                                                                alert("You have successfully linked your email to this student account!");
                                                                window.location.reload();
                                                            },
                                                        });
                                                    },
                                                });
                                        },
                                    });
                            });
                        })
                    </script>
                <?php } ?>
            </form>
            <div class="modal-footer">
                <?php if($user != 1){ ?>
                    <div class="btn btn-primary pull-right" id="submitGenInfo">Submit</div>
                <?php } ?>
                <div class="btn btn-danger <?php if($user != 1) echo "pull-left"; ?>" onclick="signOut();">Exit</div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#newUserModal").modal({
            backdrop: 'static',
            keyboard: true,
            show: true,
        });
        $("#newUserModal .select").click(function(){
            if(!$(this).hasClass("active"))
                $(this).addClass("active");
            $(this).siblings().removeClass("active");
        });
        <?php if($user != -1){ ?>
            $("#submitGenInfo").click(function(){
                var valid=validate();
                if(valid !==false)
                    $.ajax({
                        type: "POST",
                        url: "scripts/connection.php?insertInto.php",
                        data: valid,
                        success:function(response){
                            if(response.indexOf(":::") == -1)
                                alert("Contact an administrator for help. \n\nError Code: "+response);
                            else
                                $.ajax({
                                    url: "scripts/connection.php?logScript.php",
                                    success: function(){
                                        var auth2=gapi.auth2.getAuthInstance();
                                        var profile=auth2.currentUser.get().getBasicProfile();
                                        $.ajax({
                                            url: "scripts/connection.php?logScript.php",
                                            type: "POST",
                                            data: profile,
                                            success: function(response){
                                                if(response == "Email 404"){
                                                    $.ajax({
                                                        url: "scripts/connection.php?logScript.php",
                                                        type: "POST",
                                                        data: {
                                                            U3: profile.getEmail(),
                                                        },
                                                    });
                                                }
                                                window.location.reload();
                                            },
                                        });
                                    },
                                });
                        },
                    });
            });
        <?php } ?>
    });
</script>