<div class="modal fade color-black" id="medicalFormModal" tabindex="-1" role="dialog" aria-labelledby="medicalFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h4 class="modal-title" id="medicalFormModalLabel">Enter Medical Information</h4>
            </div>
            <div class="modal-body">
                <div class="row padding-4">
                    <ul class="nav pseudo-pills vertical-align text-primary no-pointer horizontal-align">
                        <li class="active">
                            <span class="fas fa-id-card fa-lg"></span>
                            Student
                        </li>
                        <span class="fas fa-angle-double-right fa-lg padding-2 margin-0"></span>
                        <li>
                            <span class="fas fa-male"></span>
                            <span class="fas fa-female"></span>
                            Parent
                        </li>
                        <span class="fas fa-angle-double-right fa-lg padding-2 margin-0"></span>
                        <li>
                            <span class="fas fa-ambulance"></span>
                            Emergency
                        </li>
                        <span class="fas fa-angle-double-right fa-lg padding-2 margin-0"></span>
                        <li> <!-- class="active" -->
                            <span class="fas fa-pen-nib"></span>
                            Signature
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <div id="medicalFormPill-Student" class="tab-pane active"> <!--active-->
                            <h4>Student Information</h4>
                            <form id="medicalForm-Student" autocomplete="off">
                                
                                <!-- Student Name & Email -->
                                <div class="row">
                                    <div class='form-group col-xs-12 col-md-5'>
                                        <label for="studName">Student Name:</label><br/>
                                        <?php echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?>
                                    </div>
                                    <div class='form-group col-xs-12 col-md-7'>
                                        <label for="studEmail">Student Email:</label><br/>
                                        <?php echo $_SESSION["email"]; ?>
                                    </div>
                                </div>
                                
                                <!-- Student ID & Graduation Year -->
                                <!--<div class="row display-none">-->
                                <!--    <div class='form-group col-xs-12 col-md-6 display-none'>-->
                                <!--        <label for="studID">Student ID: <span class="fas fa-asterisk color-red"></span></label>-->
                                <!--        <input class="form-control input" type="text" name="studID" id="studID" value="<?php echo $_SESSION['id']; ?>"/>-->
                                <!--    </div>-->
                                <!--    <div class='form-group col-xs-12 col-md-6'>-->
                                <!--        <label for="gradYear">Graduation Year: <span class="fas fa-asterisk color-red"></span></label>-->
                                <!--        <input class="form-control input" type="text" name="gradYear" id="gradYear" value="<?php echo $_SESSION['gradYear']; ?>"/>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                <!-- Birth Date & Telephone -->
                                <div class="row">
                                    <div class='form-group col-xs-12 col-md-6'>
                                        <label for="birthday">Birth Date (YYYY/MM/DD): <span class="fas fa-asterisk color-red"></span></label>
                                        <!--<div class="vertical-align">-->
                                        <!--    <div class="flex-grow">-->
                                        <input class="form-control input datepicker" type="text" name="birthday" id="birthday" required="required" placeholder="YYYY/MM/DD" title="YYYY/MM/DD"/>
                                        <!--    </div>-->
                                        <!--    <span class="padding-2" id="datepicker-birthday"></span>-->
                                        <!--</div>-->
                                        
                                    </div>
                                    <div class='form-group col-xs-12 col-md-6'>
                                        <label for="phone">Cell Phone (to be brought on trip): <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="format: 1234567890" title="format: 1234567890" name="phone" id="phone" required="required"/>
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="row">
                                    <div class='form-group col-xs-12'>
                                        <label for="address1">Address Line 1: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" name="address1" id="address1" required="required" placeholder="123 Main Street" title="123 Main Street"/>
                                    </div>
                                    <div class='form-group col-xs-12'>
                                        <label for="address2">Address Line 2: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" name="address2" id="address2" required="required" placeholder="City, State Zip" title="City, State Zip"/>
                                    </div>
                                </div>
                                <!-- T_SHIRT SIZE:	S  M  L  XL  XXL-->
                                <div class="text-center">
                                    <label style="padding-right: 10px">T-Shirt Size: <span class="fas fa-asterisk color-red"></span></label>
                                        <label class="radio-inline"><input class="pointer" type="radio" name="shirtSize" value="S" required="required"/>S</label>
                                        <label class="radio-inline"><input class="pointer" type="radio" name="shirtSize" value="M"/>M</label>
                                        <label class="radio-inline"><input class="pointer" type="radio" name="shirtSize" value="L"/>L</label>
                                        <label class="radio-inline"><input class="pointer" type="radio" name="shirtSize" value="XL"/>XL</label>
                                        <label class="radio-inline"><input class="pointer" type="radio" name="shirtSize" value="XXL"/>XXL</label>
                                </div>
                                <hr/><br/>
                                <button type="Submit" class="btn btn-primary pull-right">Next</button>
                            </form>
                        </div>
                        <div id="medicalFormPill-Parent" class="tab-pane display-none">
                            <h4>Parent Contact</h4>
                            <form id="medicalForm-Parent" autocomplete="off">
                                <!-- Parent Names -->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="parent1">Parent/Guardian 1: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" name="parent1" id="parent1" required="required" placeholder="First Last" title="First Last"/>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="parent2">Parent/Guardian 2:</label>
                                        <input class="form-control input" type="text" name="parent2" id="parent2" placeholder="First Last" title="First Last"/>
                                    </div>
                                </div>
                                <!-- Parent Phones -->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="homePhone">Primary Phone: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="format: 1234567890" title="format: 1234567890" name="homePhone" id="homePhone" required="required"/>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="altPhone">Alternate Phone:</label>
                                        <input class="form-control input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="format: 1234567890" title="format: 1234567890" name="altPhone" id="altPhone"/>
                                    </div>
                                </div>
                                <hr/><br/>
                                <button type="Submit" class="btn btn-primary pull-right">Next</button>
                            </form>
                        </div>
                        <div id="medicalFormPill-Emergency" class="tab-pane display-none">
                            <h4>Emergency Information</h4>
                            <form id="medicalForm-Emergency" autocomplete="off">
                                <div class="padding-1">
                                    If parents cannot be reached, who can be called in an emergency
                                </div>
                                <!-- Alternate Contact -->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="contact">Alternate Contact: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" name="contact" id="contact" required="required" placeholder="First Last" title="First Last"/>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="contactPhone">Phone Number: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="format: 1234567890" title="format: 1234567890" name="contactPhone" id="contactPhone" required="required"/>
                                    </div>
                                </div>
                                
                                <!-- Insurance Co & Policy # -->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="insurance">Insurance Co: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input"  type="text" name="insurance" id="insurance" required="required"/>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="insurancePolicy">Policy #: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" name="insurancePolicy" id="insurancePolicy" required="required"/>
                                    </div>
                                </div>
                                
                                <!-- Family Doctor & Phone # -->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="doctor">Family Doctor: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" name="doctor" id="doctor" required="required"/>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="doctorPhone">Doctor Phone: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="format: 1234567890" title="format: 1234567890" name="doctorPhone" id="doctorPhone" required="required"/>
                                    </div>
                                </div>
                                
                                <!-- Family Dentist & Phone # -->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="dentist">Family Dentist: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" name="dentist" id="dentist" required="required"/>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="dentistPhone">Dentist Phone: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="format: 1234567890" title="format: 1234567890" name="dentistPhone" id="dentistPhone" required="required"/>
                                    </div>
                                </div>
                                
                                <!-- Medication Needed -->
                                <div class='row'>
                                    <div class="form-group col-xs-12">
                                        <label for="medication">Medication Needed:</label>
                                        <input class="form-control input" type="text" name="medication" id="medication"/>
                                    </div>
                                </div>
                                
                                <!-- Last Tetanus -->
                                <div class="row">
                                    <div class='form-group col-xs-12'>
                                        <label for="tetanus">Last Tetanus (YYYY/MM/DD): <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input datepicker" type="text" name="tetanus" id="tetanus" required="required" placeholder="YYYY/MM/DD" title="YYYY/MM/DD"/>
                                        <span class="datepicker-content"></span>
                                    </div>
                                </div>
                                
                                <!-- Chronic injury or illness -->
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="chronic">Chronic Injury or Illness:</label>
                                        <input class="form-control input" type="text" name="chronic" id="chronic"/>
                                    </div>
                                </div>
                                
                                <!-- May take over the counter drugs(i.e., Advil, Sudafed, Benadryl, etc.)    YES	NO -->
                                <div class="container-fluid">
                                    <label>May take over the counter drugs</label> (Advil, Sudafed, Benadryl, etc.): <span class="fas fa-asterisk color-red"></span>
                                    <div class="radio">
                                        <label><input type="radio" name="counterDrugs" value="1" required="required"/>Yes</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="counterDrugs" value="0" required="required"/>No</label>
                                    </div>
                                </div>
                                
                                <!-- Allergies/Medications not to be given -->
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="allergies">Allergies/Medications NOT to be given:</label>
                                        <input class="form-control input" type="text" id="allergies"/>
                                    </div>
                                </div>
                                <hr/><br/>
                                <button type="Submit" class="btn btn-primary pull-right">Next</button>
                            </form>
                        </div>
                        <div id="medicalFormPill-Affirmation" class="tab-pane display-none"> <!-- display-none -->
                            <form id="medicalForm-Affirmation" autocomplete="off">
                                <h4>Student Affirmation</h4>
                                <div class="padding-2 bold tab">
                                    As a student of Plymouth Whitemarsh High School, I recognize that all school rules and regulations as specified in the student handbook concerning student behavior and discipline remain in effect during school sponsored field trips.
                                </div>
                                <br/>
                                <div class="row">
                                    <div class='form-group col-xs-12 col-md-6'>
                                        <label for="studentSig">Student Signature: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" name="studentSig" id="studentSig" required="required" placeholder="Type Your Name: <?php echo $_SESSION['fName'].' '.$_SESSION['lName']; ?>" title="<?php echo $_SESSION['fName'].' '.$_SESSION['lName']; ?>"/>
                                    </div>
                                    <div class='form-group col-xs-12 col-md-6'>
                                            <label for="studDate">Date: <span class="fas fa-asterisk color-red"></span></label>
                                            <input class="form-control input" type="text" name="studDate" required="required" placeholder="Current Date" title="Current Date"/>
                                    </div>
                                </div>
                                <div class="form-check-inline padding-2">
                                    <label class="display-inline form-check-label pointer" for="verifyStudent">
                                        <input class="display-inline form-check-input pointer" required="required" type="checkbox" name="verifyStudent" id="verifyStudent">
                                        I understand that checking this box, in conjunction with typing my name (first last) and date above, constitutes a legal signature confirming that I acknowledge and warrant the truthfulness of the information provided in this document.
                                    </label>
                                </div>
                                
                                <br/> <hr style="opacity: 1; border-color: #aaa"> <br/>
                                
                                <h4>Parent Affirmation</h4>
                                <div class="padding-2 bold tab">
                                    As parent/guardian of the above student, I have discussed the above rules and regulations with my child.  He/she assures me that he/she will comply with all contract provisions.  I fully understand and agree that if my child does not comply with the contract, we will be financially responsible for his/her return flight home.  I give my child permission to participate in the trip.
                                </div>
                                <br/>
                                <div class="row">
                                    <div class='form-group col-xs-12 col-md-6'>
                                        <label for="parentSig">Parent Signature: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" id="parentSig" name="parentSig" required="required" placeholder="Type Your Name" title="Type Your Name"/>
                                    </div>
                                    <div class='form-group col-xs-12 col-md-6'>
                                        <label for="parentDate">Date: <span class="fas fa-asterisk color-red"></span></label>
                                        <input class="form-control input" type="text" id="parentDate" name="parentDate" required="required" placeholder="Current Date" title="Current Date"/>
                                    </div>
                                </div>
                                <div class="form-check-inline">
                                    <label class="display-inline form-check-label pointer" for="verifyParent">
                                        <input class="display-inline form-check-input pointer" required="required" type="checkbox" id="verifyParent" name="verifyParent">
                                        I understand that checking this box, in conjunction with typing my name (first last) and date above, constitutes a legal signature confirming that I acknowledge and warrant the truthfulness of the information provided in this document.
                                    </label>
                                </div>
                                
                                <hr/><br/>
                                <button type="Submit" class="btn btn-primary pull-right">Submit</button>
                            </form>
                        </div>
                    </div>
                    
                    <div>
                        <button type="button" id="MedicalInfoBack" class="btn btn-default pull-left display-none">Back</button>
                    </div>
                    <div class="clear"><br/></div>
                    <div class="center-block col-xs-11 col-sm-10 background-red color-white margin-0 padding-3 row display-none" data-type="form-validation-error">
                        <div class="col-xs-1">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="col-xs-10" data-type="form-validation-error-message">
                            
                        </div>
                        <div class="col-xs-1">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("form").attr("autocomplete", "off");
        
        $("#parent1").change(function(){
            $("#parentSig").attr("placeholder", "Type Your Name: "+$(this).val());
            $("#parentSig").attr("title", $(this).val());
        });
        $("#studentSig").keyup(function(){
            if( $("#studentSig").val().indexOf("<?php echo $_SESSION['fName']; ?>") < 0 || $("#studentSig").val().indexOf("<?php echo $_SESSION['lName']; ?>") < 0 ){
                $("#studentSig").css("background-color", "#FFBBBB");
            }
            else if($("#studentSig").queue().length == 0)
                $("#studentSig").animate({ backgroundColor: "#A3FFA3"}).animate({ backgroundColor: "#FFFFFF"});
        });
        $("#parentSig").keyup(function() {
            var min=Math.min($("#parent1").val().length, $("#contact").val().length);
            if( $("#contact").val().length > 0 )
                min=Math.min(min, $("#contact").val().length);
            var comparor=($("#parent1").val()+$("#parent2").val()+$("#contact").val()).toLowerCase().split(" ").join("");
            if($("#parentSig").val().length < min || comparor.indexOf($("#parentSig").val().toLowerCase().split(" ").join("")) < 0 )
                    $("#parentSig").css("background-color", "#FFBBBB");
            else if($(this).queue().length == 0)
                $(this).animate({ backgroundColor: "#A3FFA3"}).animate({ backgroundColor: "#FFFFFF"});
        });
        $('input[type="tel"]').change(function(){
            $(this).val( $(this).val().replace(/\D/g,''));
            if($(this).val().length == 11 && $(this).val().charAt(0) == "1")
                $(this).val( $(this).val().substr(1) );
        });
        $("#medicalFormModal input[title='Current Date']").focus(function(){
            var color=$(this).parent().prev().find("input").css("background-color");
            if(
                $(this).parent().prev().find("input").val() == "" ||
                color !="rgb(255, 255, 255)" &&
                color !="rgb(255, 255, 254)" &&
                color !="rgb(255, 254, 254)" &&
                color !="rgb(254, 254, 254)" &&
                color !="rgb(255, 254, 255)" &&
                color !="rgb(254, 254, 255)" &&
                color !="rgb(254, 255, 255)" &&
                color !="rgb(254, 255, 254)" &&
                $(this).parent().prev().find("input").queue().length == 0
            )
                return;
            var date=new Date();
            var today=date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear();
            if($(this).val() == "")
                $(this).animate({ backgroundColor: "#A3FFA3"}).animate({ backgroundColor: "#FFFFFF"});
            $(this).val(today);
        });
        $("#medicalFormModal form").submit(function(){
            $('[data-type="form-validation-error"]').removeClass("display-none");
            var errorMessage=$('[data-type="form-validation-error-message"]');
            errorMessage.html("");
            
            $(this).find(".datepicker").each(function(){
                var date=new Date( $(this).val() );
                if(isNaN( date ) || date.getTime() > new Date().getTime()){
                    $(this).val("").animate({ backgroundColor: "#FFBBBB"});
                    errorMessage.html(errorMessage.html()+"Please enter a valid date (format: YYYY/MM/DD)"+"<br/>");
                }
                else if( $(this).attr("id") == "birthday" && !(date.getFullYear() <=(new Date().getFullYear()-2 ) ) ){ //minimum 2 years old
                    $(this).val("").animate({ backgroundColor: "#FFBBBB"});
                    errorMessage.html(errorMessage.html()+"Please enter a valid birthday (your birth-year must be before "+(new Date().getFullYear()-2)+")"+"<br/>");
                }
                else $(this).animate({ backgroundColor: "#FFFFFF"});
            });
            
            $(this).find('input[type="tel"]').each(function(){
                $(this).val( $(this).val().replace(/[^0-9]/g, "") );
                if($(this).val().length !=0 && $(this).val().length !=10 && $(this).val().length !=11) //i.e. a +1 phone number
                    $(this).val("").animate({ backgroundColor: "#FFBBBB"});
                else $(this).animate({ backgroundColor: "#FFFFFF"});
            });
            
            var eq=0;
            $("#medicalFormModal").find(".pseudo-pills").children("li").each(function(){
                if($(this).hasClass("active"))
                    return false;
                eq++;
            });
            
            var tabs=[];
            $("#medicalFormModal").find(".tab-content").children().each(function(){
                tabs.push( $(this).attr('id').substring($(this).attr("id").indexOf("-")) );
            });
            
            if( eq >=tabs.length-1 ){
                if( $("#studentSig").val().indexOf("<?php echo $_SESSION['fName']; ?>") < 0 || $("#studentSig").val().indexOf("<?php echo $_SESSION['lName']; ?>") < 0 ){
                    $("#studentSig").val("").animate({ backgroundColor: "#FFBBBB"});
                    errorMessage.html(errorMessage.html()+"You Must Sign Your Name (i.e. <?php echo $_SESSION['fName'].' '.$_SESSION['lName']; ?>)"+"<br/>");
                }
                else
                    $("#studentSig").animate({ backgroundColor: "#FFFFFF"});
                
                var parentVal="<i>"+$("#parent1").val()+"</i>";
                if($("#parent2").val() !="") parentVal +=", <i>"+$("#parent2").val()+"</i>";
                if($("#contact").val() !="") parentVal +=", <i>"+$("#contact").val()+"</i>";
                
                var min=Math.min($("#parent1").val().length, $("#contact").val().length);
                if( $("#contact").val().length > 0 )
                    min=Math.min(min, $("#contact").val().length);
                var comparor=($("#parent1").val()+$("#parent2").val()+$("#contact").val()).toLowerCase().split(" ").join("");
                if($("#parentSig").val().length < min || comparor.indexOf($("#parentSig").val().toLowerCase().split(" ").join("")) < 0 ){
                        $("#parentSig").val("").animate({ backgroundColor: "#FFBBBB"});
                        errorMessage.html(errorMessage.html()+"A Parent Must Sign Their Name (i.e. "+parentVal+")"+"<br/>");
                }
                else
                    $("#parentSig").animate({ backgroundColor: "#FFFFFF"});
                
                if(errorMessage.html() !="")
                    return false;
                $('[data-type="form-validation-error"]').addClass("display-none");
                
                var dataArr={table: "form"};
                for(var x=0; x < tabs.length-1; x++){ //-1 for Affirmations form
                    $.extend(dataArr, $("#medicalForm"+tabs[x]).serializeArray().reduce(function(obj, item) {
                        obj[item.name]=item.value.charAt(0).toUpperCase()+item.value.substring(1);
                        return obj;
                    }, {}) );
                }
                $.ajax({
                    url: "scripts/connection.php?insertInto.php",
                    type: "POST",
                    data: dataArr,
                    success: function(response){
                        if(response.indexOf(":::") == -1)
                            alert("Contact an administrator for help. \n\nError Code: "+response);
                        else
                            window.location.reload();
                    },
                    error: function(){
                        alert("There was a problem submitting the form -- check your internet connection and try again");
                    },
                });//end of form.php ajax
                return false;
            }
            if(errorMessage.html() !="") return false;
            
            
            
            $("#medicalFormModal").find(".pseudo-pills").children("li").eq(eq+1).addClass("active")
            $("#medicalFormPill"+tabs[eq+1]).addClass("active").removeClass("display-none");
            
            $("#medicalFormModal").find(".pseudo-pills").children("li").eq(eq).removeClass("active");
            $("#medicalFormPill"+tabs[eq]).removeClass("active").addClass("display-none");
            
            if(eq== tabs.length-1)
                $("#MedicalInfoNext").text("Submit")
            else
                $("#MedicalInfoNext").text("Next")
            
            if( $("#MedicalInfoBack").hasClass("display-none") && eq+1 > 0)
                $("#MedicalInfoBack").removeClass("display-none");
            
            $('[data-type="form-validation-error"]').addClass("display-none");
            return false;
        });
        $("#MedicalInfoBack").click(function(){
            $('[data-type="form-validation-error"]').addClass("display-none");
            
            var eq=0;
            $("#medicalFormModal").find(".pseudo-pills").children("li").each(function(){
                if($(this).hasClass("active"))
                    return false;
                eq++;
            });
            var tabs=[];
            $("#medicalFormModal").find(".tab-content").children().each(function(){
                tabs.push( $(this).attr('id').substring($(this).attr("id").indexOf("-")) );
            });
            $("#medicalFormPill"+tabs[eq]+" input").animate({ backgroundColor: "#FFFFFF"});
            
            $("#medicalFormModal").find(".pseudo-pills").children("li").eq(eq-1).addClass("active")
            $("#medicalFormPill"+tabs[eq-1]).addClass("active").removeClass("display-none");
            
            $("#medicalFormModal").find(".pseudo-pills").children("li").eq(eq).removeClass("active");
            $("#medicalFormPill"+tabs[eq]).removeClass("active").addClass("display-none");
        
        if( eq-1 <=0)
            $("#MedicalInfoBack").addClass("display-none");
        });
    }); //end document ready
</script>