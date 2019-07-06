<!--This page may not work, Ben is trying to fix it-->

<?php 
    include_once("includes/modals/medicalInformation.php");
    include_once("includes/modals/stats.php");
    include_once("includes/modals/roomEdit.php");
    if($_SESSION["userLevel"]>$_userType['chaperone']){
        include_once("includes/modals/busChapModal.php");
    }
    // Sydney, this modal broke the page
    // haha sucker i fixed it
?>
<!----Table---->
<div style="overflow-x:auto" class="background-white">
    <?php if($_SESSION["userLevel"] > $_userType["student"]){
        $nextTripYear=substr(nextTripYear($conn, true), 0, 4); ?>
        <div style="margin-bottom: 20px" class="col-xs-12 col-xs-push-0 col-lg-10 col-lg-push-1">
            <table class="table" id="stats">
                    <thead>
                    <tr class="nowrap">
                        <th class="border-right">
                            Class <i class="fas fa-graduation-cap"></i>
                        </th>
                        <th class="border-right">
                            Students
                        </th>
                        <th class="border-right" colspan="2">
                            Forms<br/>
                            Complete / Missing
                        </th>
                        <th class="border-right" colspan="2">
                            Payments<br/>
                            Complete / Missing
                        </th>
                        <th class="border-right" colspan="3">
                            Gender<br/>
                            Male/Female/Other
                        </th>
                        <th>
                            SM<br/>
                            <i style="font-size: .5em" class="fas fa-tshirt"></i>
                        </th>
                        <th>
                            MD<br/>
                            <i style="font-size: .725em" class="fas fa-tshirt"></i>
                        </th>
                        <th>
                            LG<br/>
                            <i style="font-size: .825em" class="fas fa-tshirt"></i>
                        </th>
                        <th>
                            XL<br/>
                            <i style="font-size: 1em" class="fas fa-tshirt"></i>
                        </th>
                    </tr>
                    </thead>
                    <tr>
                        <!--CLASS-->
                        <td class="border-right">
                            <?php echo $nextTripYear; ?>
                        </td>
                        <!--STUDENTS-->
                        <td class="border-right">
                            <?php $students=mysqli_query($conn, "SELECT * FROM `students` WHERE `gradYear`=".$nextTripYear);
                            $numStudents=mysqli_num_rows($students);
                            echo $numStudents; ?>
                        </td>
                        <!--FORMS-->
                        <td style="padding-right: 0px">
                            <div class="gender modalTrig pointer green" data-toggle="modal" data-target="#statsModal" data-id="forms">
                                <i class="fas fa-check"></i>
                                <?php $forms=mysqli_query($conn, "SELECT * FROM `form` WHERE `gradYear`=".$nextTripYear);
                                echo mysqli_num_rows($forms); ?>
                            </div>

                        </td>
                        <td class="border-right">
                            <div class="gender modalTrig pointer red" data-toggle="modal" data-target="#statsModal" data-id="forms">
                                <i class="fas fa-times"></i>
                                <?php echo $numStudents-mysqli_num_rows($forms); ?>
                            </div>
                        </td>
                        <!--PAYMENTS-->
                        <td style="padding-right: 0px">
                            <div class="gender modalTrig green pointer" data-id="payments" data-toggle="modal" data-target="#statsModal">
                                <i class="fas fa-check"></i>
                                <?php $tripTotal=0;
                                    $trip=mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`=".$nextTripYear);
                                    if(mysqli_num_rows($trip) > 0 && $row=mysqli_fetch_assoc($trip)){
                                        $tripTotal+=$row['pay1']+$row['pay2']+$row['pay3'];
                                    }

                                    $payments=mysqli_query($conn, "SELECT * FROM `transactions` WHERE `gradYear`=".$nextTripYear.' ORDER BY studID');
                                    $numPayments=0;
                                    $studID=-1;
                                    $sumTotal=0;
                                    while(mysqli_num_rows($payments) > 0 && $payRow=mysqli_fetch_assoc($payments)){
                                        if($payRow["studID"] !=$studID){
                                            if($sumTotal >=$tripTotal)
                                                $numPayments+=1;
                                            $studID=$payRow["studID"];
                                            $sumTotal=0;
                                        }
                                        $sumTotal+=intval($payRow["amount"]);
                                    }
                                echo $numPayments; ?>
                            </div>
                        </td>
                        <td class="border-right">
                            <div class="gender modalTrig red pointer" data-toggle="modal" data-target="#statsModal" data-id="payments">
                                <i class="fas fa-times"></i>
                                <?php echo $numStudents-$numPayments; ?>
                            </div>
                        </td>
                        <!--GENDER-->
                        <td style="padding-right: 0px">
                            <div class="gender modalTrig blue pointer" title="Male" data-id="gender" data-toggle="modal" data-target="#statsModal">
                                <i class="fas fa-mars"></i>
                                <?php $students=mysqli_query($conn, "SELECT * FROM `students` WHERE `gradYear`=".$nextTripYear." AND `gender`=0");
                                echo mysqli_num_rows($students); ?>
                            </div>
                        </td>
                        <td class="padding-1">
                            <div class="gender modalTrig pink pointer" title="Female" data-id="gender" data-toggle="modal" data-target="#statsModal">
                                <i class="fas fa-venus"></i>
                                <?php $students=mysqli_query($conn, "SELECT * FROM `students` WHERE `gradYear`=".$nextTripYear." AND `gender`=1");
                                echo mysqli_num_rows($students); ?>
                            </div>
                        </td>
                        <td class="border-right" style="padding-left: 0px">
                            <div class="gender modalTrig yellow pointer" title="Other"  data-id="gender" data-toggle="modal" data-target="#statsModal">
                                <i class="fas fa-genderless"></i>
                                <?php $students=mysqli_query($conn, "SELECT * FROM `students` WHERE `gradYear`=".$nextTripYear." AND `gender`=2");
                                echo mysqli_num_rows($students); ?>
                            </div>
                        
                        </td>
                        <!--SHIRT SIZE-->
                        
                        <td>
                            <div class = "modalTrig gender black pointer" data-id="shirts" data-toggle="modal" data-target="#statsModal">
                            <?php $s=mysqli_query($conn, "SELECT * FROM `form` WHERE `gradYear`=".$nextTripYear." AND `shirtSize`=\"S\" ");
                            echo mysqli_num_rows($s); ?>
                            </div>
                            
                        </td>
                        <td>
                            <div class = "gender modalTrig black pointer" data-id="shirts" data-toggle="modal" data-target="#statsModal">
                            <?php $m=mysqli_query($conn, "SELECT * FROM `form` WHERE `gradYear`=".$nextTripYear." AND `shirtSize`=\"M\" ");
                            echo mysqli_num_rows($m); ?>
                            </div>
                        </td>
                        <td>
                            <div class = "gender modalTrig black pointer" data-id="shirts" data-toggle="modal" data-target="#statsModal">
                            <?php $l=mysqli_query($conn, "SELECT * FROM `form` WHERE `gradYear`=".$nextTripYear." AND `shirtSize`=\"L\" ");
                            echo mysqli_num_rows($l); ?>
                            </div>
                        </td>
                        <td>
                            <div class = "gender modalTrig black pointer" data-id="shirts" data-toggle="modal" data-target="#statsModal">
                            <?php $xl=mysqli_query($conn, "SELECT * FROM `form` WHERE `gradYear`=".$nextTripYear." AND `shirtSize`=\"XL\" ");
                            echo mysqli_num_rows($xl); ?>
                            </div>
                        </td>
                        </div>
                    </tr>
                </table>
        </div>
    <?php } ?>

    <table id="stuTable" class='table table-hover'>
        <thead class="thead-dark">
            <tr>
                <th>Class <i class="fas fa-graduation-cap"></i></th>
                <th>Up To Date</th>
                <th>Students</th>
                <!--<th>Payed</th>-->
                <!--<th>Forms</th>-->
            </tr>
        </thead>
        <?php
            //gradYear is from trip
            //sizes are in form
            $result=mysqli_query($conn, "SELECT * FROM `trip` WHERE NOT `gradYear`=9999");
            while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $row["gradYear"]; ?></td>
                    <td>
                        <?php
                        echo "100%";
                        ?>
                    </td>
                    <td>
                        <?php $students=mysqli_query($conn, "SELECT * FROM `students` WHERE `gradYear`=".$row["gradYear"]." ORDER BY `gradYear` DESC");
                        echo mysqli_num_rows($students); ?>
                    </td>
                </tr>
            <?php } ?>
    </table>
</div>
<div class="background-white">
    <br/>
</div>

            <!------------------------------------------>
            <!------------------------------------------>
            <!-------------Student Table---------------->
            <!------------------------------------------>
            <!------------------------------------------>

<div class="container-fluid background-pink" id="students">
    <h2 class="padding-2 vertical-align">
        <div>Students</div>
        <div class="flex-grow input-group padding-3">
            <input  id="searchBar" class="form-control" type="text" placeholder="Search.."/>
            <div class="input-group-btn">
                <div class="btn btn-default" id='filterBtn' data-type="slideable" data-parent="4" data-target="#filterStudentsDiv">
                    <i class="fas fa-filter"></i>
                </div>
            </div>
        </div>
        <?php if($_SESSION['userLevel']>$_userType['chaperone']){ ?>
        <button class="btn btn-default btn-primary" data-toggle="modal" data-target="#newUserModal">
            <i class="fas fa-plus"></i> New Student
        </button>
        <button class="btn btn-default btn-warning" id='editBus'>
            <i class="fas fa-edit"></i> Edit Bus/Chaperone
        </button>
        <?php } ?>
    </h2>
    <?php include_once("includes/filterStudents.php"); ?>
    <div id="student-table-navbar" class="clear">
        <div class="students-link" id="students-link">
            Jump to:
            <?php 
                for($i=ord('a'); $i <=ord('z'); $i++) 
                    echo "<a class='pointer' href='javascript: JumpTo($(\"#\"+closestLetter(\"".chr($i)."\")))'>".strtoupper(chr($i))."</a>"; 
            ?>
        </div>
        <br/>

    </div>
    <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]){
            include_once("includes/modals/newStudent.php");
            include_once("includes/modals/studentBalance.php");
        } ?>
    <div class="container-fluid" id="container" style="max-height: 75vh; overflow-y: scroll; overflow-x: auto">
        <table id='studTbl' class='table table-responsive stickyHeader' style="margin-bottom: -5px; width: 100%;">
            <thead>
                <tr>
                    <th class="display-none" id='boxCol'>Select</th>
                    <th>Name</th>
                    <th>Balance</th>
                    <th>Contract</th>
                    <th>Medical Form</th>
                    <th>Grad Year</th>
                    <th>Chaperone</th>
                    <th>Bus #</th>
                    <th>Roommates</th>
                </tr>
            </thead>
            <?php $missingLetters=[];
            for($letter=ord('a'); $letter <= ord('z'); $letter++){
                $cLetter=chr($letter);
                if($_SESSION["userLevel"]==$_userType["sponsor"]){
                    $result=mysqli_query($conn, "SELECT * FROM `students` WHERE gradYear=".$_SESSION['gradYear']." AND `lName` LIKE '$cLetter%' ORDER BY `lName`, `fName`"); 
                }
                else if($_SESSION["userLevel"]==$_userType["chaperone"]){
                    $id=$_SESSION['id'];
                    //work in progress, plz fix
                    // sad ^^^^^
                    $result=mysqli_query($conn, "SELECT * FROM `students`,`assignments` WHERE students.studID IN (stud1,stud2,stud3,stud4) AND assignments.chapID=$id AND `lName` LIKE '$cLetter%' ORDER BY `lName`, `fName`"); 
                }
                else if($_SESSION["userLevel"]==$_userType["admin"]){
                $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `lName` LIKE '$cLetter%' ORDER BY `lName`, `fName`");   
                }
                if($result&&mysqli_num_rows($result) > 0){
                    echo "<tbody class='letterHeader'>";
                    echo "<tr id='$cLetter'><th colspan='99' class='color-white text-left' style='background-color: rgba(255, 255, 255, .1)'>".strtoupper($cLetter)."</th></tr>";
                    $genderClass="";
                    while($row=mysqli_fetch_assoc($result)){

                        $studID=$row['studID']; ?>
                        <tr class='studListing <?php if($_SESSION["userLevel"] == $_userType["admin"] && $row['gradYear'] != substr(nextTripYear($conn, true), 0, 4)) echo "hide";?>' title='<?php echo $studID; ?>' style='vertical-align:middle'>
                        <?php
                        $genderClass="fas fa-lg ";
                        if($row["gender"] == 0)
                            $genderClass.="fa-mars color-gender-male";
                        else if($row["gender"] == 1)
                            $genderClass.="fa-venus color-gender-female";
                        else
                            $genderClass.="fa-genderless color-gender-other";
                            
                        $fn = ucfirst($row['fName']); 
                        $ln = ucfirst($row['lName']); 
                        echo "<td  class='display-none'><input type='checkbox' name='assign' class='box' /></td>"; //This is the code that broke search; 
                        //right here. why, this is the reason working with other people is annoying. Was this Hana? i feel like it was
                        //this was something that she would do, add something display none instead of adding it with jquery ...
            /*<td>*/    echo "<td name='gender' value='".$row['gender']."' style='text-align:left' class='studName'><i class='$genderClass'></i> $fn $ln </td>"; 
                        $raised=$row['balance']; 
                        
            /*<td>*/    echo "<td name='balance' value='$raised'><span id='balanceTR' data-id='$studID' class='a pointer' data-toggle='modal' onclick='populateStudentBalanceModal($studID)' data-target='#studentBalance'>$$raised</span></td>"; 
                        if ($row["seniorTripContract"] == 0)
                            $contract="<i class='fas fa-times' style='color: #FF0000'></i>";
                        else
                            $contract="<i class='fas fa-check color-green'></i>";
            /*<td>*/    echo "<td>".$contract."</td>";
            
                        $colorResult = mysqli_query($conn, "SELECT * FROM `form` WHERE `studID`='".$row["studID"]."'");
                        $color = mysqli_num_rows($colorResult);
            /*<td>*/    echo "<td name='forms' value='$color'>";
                        ?>
                        <button type="button" class="btn btn-<?php echo ($color > 0)? "success" : "danger";; ?> btn-sm" data-toggle="modal" data-target="#medicalInfoModal"><i class="fas fa-info-circle"></i> Medical Info</button>
                  <?php echo "</td>";
           
            /*<td>*/    echo "<td name='gradYear' value='{$row['gradYear']}'>"; 
                        echo $row['gradYear'];
                        echo "</td>";
                        
                        
                        $assignmentResult = mysqli_query($conn, "SELECT * FROM `assignments` WHERE '$studID' in(stud1, stud2, stud3, stud4)");
                        $assignmentRow = array();
                        if(mysqli_num_rows($assignmentResult) > 0){
                            $assignmentRow = mysqli_fetch_assoc($assignmentResult);
                        }
            /*<td>*/    echo "<td name='chaparone' class='chap' value='{$assignmentRow['chapID']}'>"; 
                        if( is_null($assignmentRow['chapID']) )
                            echo "N/A";
                        else{
                            $chapID = $assignmentRow['chapID'];
                            $chapResult = mysqli_query($conn,"SELECT * from chaperones where chapID=$chapID");
                            $chapResult = mysqli_fetch_assoc($chapResult);
                            echo $chapResult['fName']." ".$chapResult['lName'];
                        }
                        echo "</td>";
                        $bus = $assignmentRow["bus"];
            /*<td>*/    echo "<td value='$bus' class='bus'>";
                        if(is_null($bus))
                            echo "N/A";
                        else
                            echo $bus;
                        echo "</td>";
            /*<td>*/    //echo "<td class='room' data-target='#roomModal' data-toggle='modal'>";
                        if(mysqli_num_rows($assignmentResult)>0){
                            $roomies=array($assignmentRow["stud1"], $assignmentRow["stud2"], $assignmentRow["stud3"], $assignmentRow["stud4"]);
                            for($x=0; $x<4; $x++){
                                if(!is_null($roomies[$x])){
                                    $stud = mysqli_query($conn,"SELECT * from students WHERE studID='".$roomies[$x]."'");
                                    if(mysqli_num_rows($stud) && $studRow = mysqli_fetch_assoc($stud))
                                        $roomies[$x] = $studRow['fName']." ".$studRow['mName']." ".$studRow['lName'];
                                    else{
                                        mysqli_query($conn, "UPDATE `assignments` SET `stud".($x+1)."`=NULL WHERE `id`='{$assignmentRow['id']}'");
                                        $roomies[$x] = "EMPTY";
                                    }
                                }
                                else
                                    $roomies[$x] = "EMPTY";
                            }
                            $count = count($roomies) - count(array_keys($roomies, "EMPTY"));
                            echo "<td name='rooms' value='$count' data-id='{$assignmentRow['id']}' class='room pointer a' data-target='#roomModal' data-toggle='modal'>";
                            echo $count."/".count($roomies);
                            echo "</td>";
                        }
                        else
                            echo "<td name='rooms' value='0' class='room pointer a' data-target='#roomModal' data-toggle='modal'>No Room</td>";
                        
                  
           /* END */    echo "</tr>";
                    }
                    echo "</tbody>";
                }
                else
                    array_push($missingLetters, chr($letter));
            } ?>
        </table>
    </div>
    <br/>
</div>
<script>
    $(document).ready(function(){
        $("#balanceTR").click(function(){
            //alert($(this));
        });
    });
    function closestLetter(letter){
        var f=letter.toLowerCase();
        var b=letter.toLowerCase();
        var arr=<?php echo json_encode($missingLetters); ?>;
        for(var i=0; i<arr.letter; i++)
            arr[i]=arr[i].toLowerCase();

        while( !(
            (!arr.includes(b) && b.charCodeAt() >=('a').charCodeAt()) ||
            (!arr.includes(f) && f.charCodeAt() <=('z').charCodeAt())
        ) ){
            b=String.fromCharCode(b.charCodeAt() - 1);
            f=String.fromCharCode(f.charCodeAt() + 1);
        }
        if( b.charCodeAt() >='a'.charCodeAt() && !arr.includes(b))
            return b;
        else if(f.charCodeAt() <='z'.charCodeAt() && !arr.includes(f))
            return f;

        return "students-link";
    }
</script>
<?php
if($_SESSION['userLevel']>$_userType['chaperone']){//edit bus/chaperone scripts
    ?>
    <script>
        $('#editBus').click(function(){
            if($(this).text().indexOf("Edit Bus/Chaperone")!=-1){
                $(this).text("Assign Changes");
           $('th').removeClass("display-none");
           $('td').removeClass("display-none");
           //reset some values
           $( ".box" ).prop( "checked", false );
           $('#eBus').val("");
           $("#eChap").val($("#eChap option:first").val());
            }
            else{
                $('#busChapModal').modal('show'); 
            }
        });
        $("td[name=rooms]").click(function(){
            var room = $(this).attr("data-id");
            //alert(room);
            if (room !== undefined){
                $.ajax({
                    url: "scripts/connection.php?getRoomies.php",
                    type: "POST",
                    data: {
                        id: room,
                    },
                    success:function(response){
                        var arr = response.split(",")
                        //alert(arr);
                        for (var i = 0; i < arr.length; i++){
                            if(arr[i]==""){
                                $("#roomKid"+(i+1)+"").attr("placeholder","Search for a student...");
                            }
                            else{
                                $("#roomKid"+(i+1)+"").val(arr[i]);
                            }
                            if(arr[i+4]==""){
                                $("#roomId"+(i+1)+"").text("Student "+(i+1));
                            }
                            else{
                                $("#roomId"+(i+1)+"").text(arr[i+4]);
                            }
                        }
                    },
                    error:function(){
                        alert("could not connect to the database");
                    },
                });
            }
            if(room==undefined){
                for(var i=1; i<5;i++){
                    $("#roomKid"+i).attr("placeholder","Search for a student...").val("");
                    $("#roomId"+i).text("Student "+i);
                }
            }
        });
    </script>
    <?php
}
?>