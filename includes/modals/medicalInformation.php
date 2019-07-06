<?php $student=$_SESSION["userLevel"] == $_userType["student"];
if($student){
    $result=mysqli_query($conn, "SELECT * FROM `form` WHERE `studID`=".$_SESSION["id"]);
    $student=( mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result) );
}
?>
<div class="modal fade color-black" id="medicalInfoModal" tabindex="-1" role="dialog" aria-labelledby="medicalInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h3 class="modal-title vertical-align" id="medicalInfoModalLabel">
                    <a id="medicalPDFLink" href="scripts/connection.php?../files/pdf.php&studID=30023" target="_blank" class="color-blue border-bottom padding-3" style="margin-right: 25px;">
                        <i class="fas fa-file-pdf" style="padding-right:3px"></i><i class="fa-sm fas fa-external-link-alt"></i>
                    </a>
                    Medical Information
                </h3>
            </div>
            <div class="modal-body">
                
                <div class="alert alert-danger display-none text-center">
                    This student has not yet filled out their Medical Information Form.
                </div>
                <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]){ ?>
                <span class="top btn background-blue padding-2 pull-right">
                    <aside data-parent="2" data-type="edit">
                        <i class="fas fa-edit"></i>Edit
                    </aside>
                </span>
                <?php } ?>
                <h4>Student Information</h4>
                <!-- Student Name & Email -->
                <div class="row">
                    <div class='form-group col-xs-12 col-md-5'>
                        <label>Student Name:</label><br/>
                        <div id="studName">
                            <span id="fName" data-table="students" data-field="fName" where-studID="" data-type="editable"><?php if($student) echo $_SESSION["fName"]; ?></span>
                            <span id="mName" data-table="students" data-field="mName" where-studID="" data-type="editable"><?php if($student) echo $_SESSION["mName"]; ?></span>
                            <span id="lName" data-table="students" data-field="lName" where-studID="" data-type="editable"><?php if($student) echo $_SESSION["lName"]; ?></span>
                        </div>
                    </div>
                    <div class='form-group col-xs-12 col-md-7'>
                        <label for="email">Student Email:</label><br/>
                        <div id="email" data-table="students" data-field="email" where-studID="" data-type="editable"><?php if($student) echo $_SESSION["email"]; ?></div>
                    </div>
                </div>
                <!-- Student ID & Grad Year & Birth Date -->
                <div class="row">
                    <div class='form-group col-xs-12 col-sm-6 col-md-4'>
                        <label for="studID">Student ID:</label><br/>
                        <div id="studID" data-table="students" data-field="studID" where-studID="" data-type="editable"><?php if($student) echo $row["studID"]; ?></div>
                    </div>
                    <div class='form-group col-xs-12 col-sm-6 col-md-4'>
                        <label for="gradYear">Graduation Year:</label><br/>
                        <div id="gradYear" data-table="students" data-field="gradYear" where-studID="" data-type="editable"><?php if($student) echo $row["gradYear"]; ?></div>
                    </div>
                    <div class='form-group col-xs-12 col-sm-6 col-md-4'>
                        <label for="birthday">Birth Date (MM/DD/YYYY):</label>
                        <div id="birthday" data-table="form" data-field="birthday" where-studID="" data-type="editable"><?php if($student) echo $row["birthday"]; ?></div>
                    </div>
                </div>
                <!-- Address -->
                <div class="row">
                    <div class='form-group col-xs-12'>
                        <label for="address1">Address Line 1:</label>
                        <div id="address1" data-table="form" data-field="address1" where-studID="" data-type="editable"><?php if($student) echo $row["address1"]; ?></div>
                    </div>
                    <div class='form-group col-xs-12'>
                        <label for="address2">Address Line 2:</label>
                        <div id="address2" data-table="form" data-field="address2" where-studID="" data-type="editable"><?php if($student) echo $row["address2"]; ?></div>
                    </div>
                </div>
                <!-- T_SHIRT SIZE:	S  M  L  XL  XXL-->
                <div class="row">
                    <div class='form-group col-xs-12 col-md-6'>
                        <label for="phone">Phone:</label>
                        <div id="phone" data-table="form" data-field="phone" where-studID="" data-type="editable"><?php if($student) echo $row["phone"]; ?></div>
                    </div>
                    <div class='form-group col-xs-12 col-md-6'>
                        <label for="shirtSize">T-Shirt Size:</label>
                        <div id="shirtSize" data-table="form" data-field="shirtSize" where-studID="" data-type="editable"><?php if($student) echo $row["shirtSize"]; ?></div>
                    </div>
                </div>
                <hr/>
                <h4>Parent Contact</h4>
                <!-- Parent Names -->
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="parent1">Parent/Guardian 1:</label>
                        <div id="parent1" data-table="form" data-field="parent1" where-studID="" data-type="editable"><?php if($student) echo $row["parent1"]; ?></div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="parent2">Parent/Guardian 2:</label>
                        <div id="parent2" data-table="form" data-field="parent2" where-studID="" data-type="editable"><?php if($student) echo $row["parent2"]; ?></div>
                    </div>
                </div>
                <!-- Parent Phones -->
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="homePhone">Primary Phone:</label>
                        <div id="homePhone" data-table="form" data-field="homePhone" where-studID="" data-type="editable"><?php if($student) echo $row["homePhone"]; ?></div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="altPhone">Alternate Phone:</label>
                        <div id="altPhone" data-table="form" data-field="altPhone" where-studID="" data-type="editable"><?php if($student) echo $row["altPhone"]; ?></div>
                    </div>
                </div>
                <hr/>
                <h4>Emergency Information</h4>
                <div class="padding-1">
                    If parents cannot be reached, who can be called in an emergency
                </div>
                <!-- Alternate Contact -->
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="contact">Alternate Contact:</label>
                        <div id="contact" data-table="form" data-field="contact" where-studID="" data-type="editable"><?php if($student) echo $row["contact"]; ?></div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="contactPhone">Phone Number:</label>
                        <div id="contactPhone" data-table="form" data-field="contactPhone" where-studID="" data-type="editable"><?php if($student) echo $row["contactPhone"]; ?></div>
                    </div>
                </div>
                <!-- Insurance Co & Policy # -->
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="insurance">Insurance Co:</label>
                        <div id="insurance" data-table="form" data-field="insurance" where-studID="" data-type="editable"><?php if($student) echo $row["insurance"]; ?></div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="insurancePolicy">Policy #:</label>
                        <div id="insurancePolicy" data-table="form" data-field="insurancePolicy" where-studID="" data-type="editable"><?php if($student) echo $row["insurancePolicy"]; ?></div>
                    </div>
                </div>
                <!-- Family Doctor & Phone # -->
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="doctor">Family Doctor:</label>
                        <div id="doctor" data-table="form" data-field="doctor" where-studID="" data-type="editable"><?php if($student) echo $row["doctor"]; ?></div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="doctorPhone">Doctor Phone:</label>
                        <div id="doctorPhone" data-table="form" data-field="doctorPhone" where-studID="" data-type="editable"><?php if($student) echo $row["doctorPhone"]; ?></div>
                    </div>
                </div>
                <!-- Family Dentist & Phone # -->
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="dentist">Family Dentist:</label>
                        <div id="dentist" data-table="form" data-field="dentist" where-studID="" data-type="editable"><?php if($student) echo $row["dentist"]; ?></div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="dentistPhone">Dentist Phone:</label>
                        <div id="dentistPhone" data-table="form" data-field="dentistPhone" where-studID="" data-type="editable"><?php if($student) echo $row["dentistPhone"]; ?></div>
                    </div>
                </div>
                <!-- Medication Needed -->
                <div class='row'>
                    <div class="form-group col-xs-12">
                        <label for="medication">Medication Needed:</label>
                        <div id="medication" data-table="form" data-field="medication" where-studID="" data-type="editable"><?php if($student) echo $row["medication"]; ?></div>
                    </div>
                </div>
                <!-- Last Tetanus -->
                <div class="row">
                    <div class='form-group col-xs-12'>
                        <label for="tetanus">Last Tetanus (MM/DD/YYYY):</label>
                        <div id="tetanus" data-table="form" data-field="tetanus" where-studID="" data-type="editable"><?php if($student) echo $row["tetanus"]; ?></div>
                    </div>
                </div>
                <!-- Chronic injury or illness -->
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="chronic">Chronic Injury or Illness:</label>
                        <div id="chronic" data-table="form" data-field="chronic" where-studID="" data-type="editable"><?php if($student) echo $row["chronic"]; ?></div>
                    </div>
                </div>
                <!-- May take over the counter drugs(i.e., Advil, Sudafed, Benadryl, etc.)    YES	NO -->
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="counterDrugs">May take over the counter drugs</label> (Advil, Sudafed, Benadryl, etc.):
                        <div id="counterDrugs" data-table="form" data-field="counterDrugs" where-studID="" data-type="editable"><?php if($student) echo $row["counterDrugs"]; ?></div>
                    </div>
                </div>
                <!-- Allergies/Medications not to be given -->
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="allergies">Allergies/Medications NOT to be given:</label>
                        <div id="allergies" data-table="form" data-field="allergies" where-studID="" data-type="editable"><?php if($student) echo $row["allergies"]; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    // var target=$("#medicalInfoModal [for]");
    // target.each(function(){
    //     $("#medicalInfoModal #"+$(this).attr("for")).addClass("tab");
    // });
    <?php if($student){ ?>
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
    <?php } ?>
});
</script>