<div class="modal fade" id="statsModal" tabindex="-1" role="dialog" aria-labelledby="statsModal" aria-hidden="true" style="overflow-y: clipped">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h3 class="modal-title text-center statsForms">Forms</span></h3>
                <h3 class="modal-title text-center statsPayments">Payments</span></h3>
                <h3 class="modal-title text-center statsGender">Gender</span></h3>
                <h3 class="modal-title text-center statsShirts">Shirts</span></h3>
            </div>
            <div class="modal-body" style="overflow-y:scroll; max-height: 80vh;">
                <div class="statsForms display-none">
                    <div class="row">
                        <div class="col-xs-6 display-inline">
                            <div class="gender green center-block text-center" style="width:100px">Complete</div>
                            <ul class="list-group padding-4">
                                <?php 
                                    $nextTripYear=substr(nextTripYear($conn, true), 0, 4);
                                    $ids=array();
                                    $result=mysqli_query($conn, "SELECT * FROM `form` WHERE `gradYear`=".$nextTripYear);
                                    while ($row=mysqli_fetch_assoc($result)){ 
                                        array_push($ids,$row["studID"]);
                                    }
                                    for ($i=0; $i<count($ids); $i++){
                                        $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`=".$ids[$i]." ORDER BY `lName`");
                                        while ($row=mysqli_fetch_assoc($result)){
                                        ?>
                                            <li class="list-group-item"><?php echo $row["lName"]; ?></li>
                                        <?php 
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-xs-6 display-inline">
                            <div class="gender red text-center center-block" style="width:120px">Missing</div>
                            <div id="remindButton" class="remindButton margin-2 warning orange text-center center-block"><i class="fas pointer fa-envelope padding-1"></i>EMAIL STUDENTS WITH INCOMPLETE FORMS</div>
                            <ul class="list-group padding-4">
                                <?php 
                                    $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `gradYear`=".$nextTripYear);
                                    while ($row=mysqli_fetch_assoc($result)){
                                        $found=false;
                                        for ($i=0; $i < count($ids); $i++){
                                            if ($row["studID"] == $ids[$i]){
                                                $found=true;
                                            }
                                        }
                                        if (!$found){ ?>
                                            <li class="list-group-item" dataId="<?php echo $row['studID'];?>" ><?php echo $row["lName"]; ?></li>
                                        <?php 
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="statsPayments display-none">
                    <div class="row">
                        <div class="col-xs-6 display-inline">
                            <div class="gender green text-center center-block" style="width:100px">Complete</div>
                            <ul class="padding-4">
                            <?php 
                                $students=array();
                                $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `gradYear`=".$nextTripYear);
                                while ($row=mysqli_fetch_assoc($result)){
                                    array_push($students,$row["studID"]);
                                }
                                $completeIDS=array();
                                for ($i=0; $i < count($students); $i++){
                                    $raised=0;
                                    $id=$students[$i];
                                    $result=mysqli_query($conn, "SELECT * FROM `transactions` WHERE `studID`=".$students[$i]." ORDER BY `studID`");
                                    while ($row=mysqli_fetch_assoc($result)){
                                        $raised +=$row["amount"];
                                    }
                                    $totalPayments=1880;
                                    if ($raised >=$totalPayments){ 
                                        array_push($completeIDS, $id);
                                    ?>
                                        <li class="list-group-item"><?php echo $id; ?></li>
                                    <?php   
                                    }
                                }
                            ?>
                            </ul>
                        </div>
                        <div class="col-xs-6 display-inline">
                            <div class="gender red text-center center-block" style="width:110px">
                                Incomplete
                            </div>
                            <div id="remindButton" class="remindButton margin-2 warning orange text-center center-block"><i class="fas pointer fa-envelope padding-1"></i>EMAIL STUDENTS WITH INCOMPLETE PAYMENTS</div>
                            <ul class="padding-4">
                                <?php
                                    for ($i=0; $i<count($students); $i++){
                                        for ($j=0; $j<count($completeIDS); $j++){
                                            if ($students[$i] == $completeIDS[$j]){
                                                unset($students[$i]);
                                            }
                                        }
                                    }
                                    for ($i=0; $i<count($students); $i++){
                                        $result=mysqli_query($conn,"SELECT * FROM `students` WHERE `studID`='".$students[$i]."' ORDER BY `studID`");
                                        while ($row=mysqli_fetch_assoc($result)){
                                            ?>
                                            <li class="list-group-item"  dataId="<?php echo $row['studID'];?>"  ><?php echo $row["lName"]; ?></li>
                                            <?php 
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="statsGender display-none">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="gender blue text-center center-block" style="width:60px">Male</div>
                            <ul class="padding-4">
                                <?php 
                                    $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `gender`=0 ORDER BY `lName`");
                                    while ($row=mysqli_fetch_assoc($result)){
                                        ?>
                                        <li class="list-group-item"><?php echo $row["lName"]; ?></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-xs-4">
                            <div class="gender pink text-center center-block" style="width:90px">Female</div>
                            <ul class="padding-4">
                                <?php 
                                    $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `gender`=1 ORDER BY `lName`");
                                    while ($row=mysqli_fetch_assoc($result)){
                                        ?>
                                        <li class="list-group-item id" ><?php echo $row["lName"]; ?></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-xs-4">
                            <div class="gender yellow text-center center-block" style="width:60px">Other</div>
                            <ul class="padding-4">
                                <?php 
                                    $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `gender`=2 ORDER BY `lName`");
                                    while ($row=mysqli_fetch_assoc($result)){
                                        ?>
                                        <li class="list-group-item"><?php echo $row["lName"]; ?></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class = "statsShirts display-none">
                    <?php 
                        $small = array();
                        $medium = array();
                        $large = array();
                        $xlarge = array();
                        $result=mysqli_query($conn, "SELECT * FROM `form`");
                        while ($row=mysqli_fetch_assoc($result)){
                            if($row["shirtSize"] == "S"){
                                array_push($small, $row["studID"]);
                            }
                            else if($row["shirtSize"] == "M"){
                                array_push($medium, $row["studID"]);
                            }
                            else if($row["shirtSize"] == "L"){
                                array_push($large, $row["studID"]);
                            }
                            else if($row["shirtSize"] == "XL"){
                                array_push($xlarge, $row["studID"]);
                            }
                        }
                    ?>
                    <div class = "row">
                        <div class="col-xs-3">
                            <div class="gender black text-center center-block" style="width:60px">Small</div>
                            <ul class = "padding-4">
                                <?php 
                                    for ($i = 0; $i < count($small); $i++){
                                        $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`='".$small[$i]."';");
                                        while (mysqli_num_rows($result)>0 && $row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <li class = "list-group-item"><?php echo $row["lName"]; ?></li>
                                            <?php 
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class = "col-xs-3">
                            <div class="gender black text-center center-block" style="width:70px">Medium</div>
                            <ul class = "padding-4">
                                <?php
                                    for ($x = 0; $x < count($medium); $x++){
                                        $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`='".$medium[$x]."';");
                                        while (mysqli_num_rows($result)>0 && $row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <li class = "list-group-item"><?php echo $row["lName"]; ?></li>
                                            <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class = "col-xs-3">
                            <div class="gender black text-center center-block" style="width:80px">Large</div>
                            <ul class = "padding-4">
                                <?php
                                ?>
                            </ul>
                        </div>
                        <div class = "col-xs-3">
                            <div class="gender black text-center center-block" style="width:100px">Extra Large</div>
                            <ul class = "padding-4">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $(".modalTrig").click(function(){
        var target = $(this).attr("data-id");
        if (target == "forms"){
            $(".statsForms").removeClass("display-none");
            $(".statsPayments").addClass("display-none");
            $(".statsGender").addClass("display-none");
            $(".statsShirts").addClass("display-none");
        }
        else if (target == "payments"){
            $(".statsPayments").removeClass("display-none");
            $(".statsForms").addClass("display-none");
            $(".statsGender").addClass("display-none");
            $(".statsShirts").addClass("display-none");
        }
        else if (target == "shirts"){
            $(".statsShirts").removeClass("display-none");
            $(".statsForms").addClass("display-none");
            $(".statsGender").addClass("display-none");
            $(".statsPayments").addClass("display-none");
        }
        else {
            $(".statsGender").removeClass("display-none");
            $(".statsShirts").addClass("display-none");
            $(".statsPayments").addClass("display-none");
            $(".statsForms").addClass("display-none");
        }
    });
});
</script>