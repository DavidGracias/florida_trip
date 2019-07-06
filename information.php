<div class="color-orange fa-lg padding-2 pointer underline underline-orange" id="">
    <span class="fa-lg fas fa-exclamation-triangle"></span>
    Rules
    <span class="fa-lg fas fa-angle-double-down pull-right"></span>
</div>
<div class="color-black background-orange display-none">
    <div class="container-fluid padding-4 flex-start" id="rules">
        <ul class="display-inline nav nav-pills nav-xs-vertical">
            <button data-target="#rulesList0" id="beforeRules" class="ruleBtns btn btn-default btn-md"><li class="center-block">After Signing Up</li></button>
            </br>
            <button data-target="#rulesList1" id="afterRules" class="ruleBtns btn btn-default btn-md"><li class="center-block">During the Trip</li></button>
        </ul>
        <div id="rulesContent" style="margin: 10px 0px 10px 15px" class="flex-grow padding-3 background-white">
            <?php $counter=0;
                $prefix="rules-";
                $result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc` LIKE '$prefix%' ORDER BY `desc` DESC");
                while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
                    $rules=explode("::", $row["content"]); ?>
                <div id="rulesList<?php echo $counter; ?>" class="rules <?php if($counter++ !=0) echo 'display-none'; ?>">
                    <h3 class="text-center"><span class="underline"><?php echo $row["extra"];?></span></h3>
            <?php
                for ($i=0; $i < count($rules); $i++){ ?>
                    <div class='listItem flex-start flex-nowrap'>
                    <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                        <span class="btn padding-1">
                            <aside data-parent="2" data-type="delete">
                                <i class="fas fa-times"></i>
                            </aside>
                        </span>
                        <span class="btn background-purple" style="padding: 1px 2px 1px 3px; margin: 0px 4px">
                            <aside data-parent="2" data-type="edit">
                                <i class="fas fa-edit"></i>
                            </aside>
                        </span>
                    <?php }
                    else{ ?>
                        <span style='font-size: .8em; padding-top: 4px'>
                            <i class='bullet fas fa-lg fa-angle-double-right color-orange'></i>
                        </span>
                    <?php } ?>
                        <span <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-type="editable"';?> class='flex-grow'><?php echo $rules[$i] ?></span>
                    </div>
                <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!--END RULES-->
<br/>
<!--START TIPS AND TRICKS-->
<div class="color-blue fa-lg padding-2 pointer underline underline-blue" id="">
    <span class="fa-lg fas fa-plane"></span>
    Traveling Tips and Tricks

    <span class="fa-lg fas fa-angle-double-down pull-right"></span>
</div>
<div class="color-white background-blue display-none">
    <div class="container-fluid padding-4" id="tips">
        <?php
            $prefix="TravelingList-";
            $result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc` LIKE \"$prefix%\" ");
            while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
                $list=explode($_DELIMITER, $row["content"]);
                $counter=0;
                if(count($list)== 0) continue;
                ?>
                <div class='panel col-md-5 col-sm-12' >
                    <h4 class="panel-heading color-black tip-header pointer">
                        <?php echo substr($row["desc"], strlen($prefix)); ?>
                        <span class="fas fa-angle-double-down pull-right"></span>
                    </h4>
                    <div class='container-fluid panel-body no-pointer' style="display:none">
                        <ul class="list-group">
                            <?php foreach($list as $value){ 
                                
                            ?>
                                <li class='list-group-item color-black'>
                                    <div>
                                        <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                                            <!--<aside data-parent="1" data-type="edit">-->
                                            <!--    <i class="fas fa-edit"></i>-->
                                            <!--    Edit-->
                                            <!--</aside>-->
                                            <?php } ?>
                                            <div data-table="general" data-field="content" where-desc="" data-type="editable"><?php
                                                echo $value;
                                            ?></div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                
            <?php } ?>
    </div>
</div>
<!-- End Tips&tricks-->
<br/>
<!-- Start Packing List-->
<div class="color-purple fa-lg padding-2 pointer underline underline-purple">
    <span class="fa-lg fas fa-suitcase-rolling"></span>
    Packing List
    <span class="fa-lg fas fa-angle-double-down pull-right"></span>
</div>
<div class="background-purple display-none container-fluid">
    <div class="row flex-stretch flex-wrap">
        <?php
        $gender=0;
        if( $_SESSION["userLevel"]== $_userType["student"] && isset($_SESSION["id"]) ){
            $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`=".$_SESSION["id"]);
            if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result))
                if($row["gender"]== 1)
                    $gender=$row["gender"];
        } ?>
        <div class="col-xs-12 col-sm-3 padding-4 container-fluid">
            <div class="col-xs-12 flex-nowrap"> 
                <div class="btn text-center pointer" id="male">
                    <span class="color-white fas fa-male"></span>
                    <span class="color-white <?php if($gender== 0) echo "underline"; ?>">Male</span>
                </div>
                <div class="btn text-center pointer" id="female">
                    <span class="color-white fas fa-female"></span>
                    <span class="color-white <?php if($gender== 1) echo "underline"; ?>">Female</span>
                </div>
            </div>
            <div class="col-xs-12 vertical-align">
                <img src="images/information/packing_guide/<?php echo ($gender== 0)? "male": "female"; ?>.png" id="listPic" class="center-block padding-4"/>
            </div>
        </div>
        <?php for($i=0; $i < 2; $i++){ ?>
                <div class="col-xs-12 col-sm-9 row <?php if($i !=$gender) echo "display-none"; ?>">
                    <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                        <div style="margin: 10px 15px; border-radius: 15px" class="padding-4 background-white padding-4">
                            Drag an item to change the positioning of it within the list
                        </div>
                    <?php } ?>
                    <div></div>
                    <?php
                    $prefix="PackingList-";
                    $result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc` LIKE \"$prefix%\" ");
                    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                        <div style="padding: 0px 7.5px" class="col-xs-12 col-sm-4 text-center" id="<?php echo $row['desc']."-$i"; ?>">
                            <h4 class="color-white text-center underline">
                                <?php echo substr($row["desc"], strlen($prefix)); ?>
                            </h4>
                            <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                                <button style="margin-bottom: 5px" class="addPackingItem btn-primary padding-1 btn center-block pointer color-white">
                                    Add Item 
                                    <i class="fas fa-plus pull-right" style="margin-top:3px; margin-left:10px"></i>
                                </button>
                            <?php } ?>
                            <div class="packing-list color-white container-fluid text-left display-inline">
                                <?php //male=content; female=extra;
                                $fixContent=$i== 0 && $row["content"]== "";
                                if($fixContent)
                                    $row["content"]=getDefault($row['desc'], "content");
                                $fixExtra=$i== 1 && $row["extra"]== "";
                                if($fixExtra)
                                    $row["extra"]=getDefault($row['desc'], "extra");
                                    
                                $list=explode("\n", $row[ ($i== 0)?"content" : "extra"]);
                                foreach($list as $value){
                                    if(strlen(preg_replace("/[\s]/", "", $value))== 0)
                                        continue;
                                    
                                    $bullet="fa-xs fas fa-circle";
                                    if($_SESSION["userLevel"] >=$_userType["admin"])
                                        $bullet="pointer fa-lg fas fa-times";
                                    else if( $_SESSION["userLevel"]== $_userType["student"] ){
                                        $trip=mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`=".$_SESSION["gradYear"]);
                                        if(mysqli_num_rows($trip) > 0 && $tripRow=mysqli_fetch_assoc($trip)){
                                            //checks to see if florida is within two weeks
                                            if( date("Y/m/d", strtotime('+14 days') ) >=date("Y/m/d", strtotime($tripRow["floridaStart"])) ){
                                                $bullet="pointer fa-lg far fa-square color-yellow";
                                                $student=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`=".$_SESSION["id"]);
                                                if(mysqli_num_rows($student) > 0 && $studRow=mysqli_fetch_assoc($student)){
                                                    $list=explode(":::", strtolower($studRow["packingList"]));
                                                    if(in_array(strtolower($value), $list))
                                                        $bullet="pointer fa-lg far fa-check-square color-green";
                                                }
                                            }
                                        }
                                        
                                    }
                                        
                                    ?>
                                    <div class="packingItem flex-start flex-nowrap background-purple color-white border-radius <?php if($_SESSION["userLevel"] >=$_userType["admin"]) echo 'draggable'; ?>">
                                        <span class="vertical-align flex-nowrap pointer" style="font-size: .8em; padding-top: 1.75px">
                                            <i class="padding-2 <?php echo $bullet; ?>" data-id="<?php echo $_SESSION['id']; ?>"></i>
                                        </span>
                                        <span class="flex-grow" style="word-wrap: break-word"><?php
                                            echo $value;
                                        ?></span>
                                    </div>
                                <?php }
                                if($fixContent)
                                    echo "<script> updatePackingList( $('#".$row['desc']."-$i'), 'content'); </script>";
                                if($fixExtra)
                                    echo "<script> updatePackingList( $('#'".$row['desc']."-$i'), 'extra'); </script>";
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        <?php } ?>
    </div> <br/>
    <?php
    
    $result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc`=\"PackingNote\" ");
    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
        if(strlen($row['content'])== 0 && !($_SESSION["userLevel"] >=$_userType["admin"]))
            continue
    ?>
    <div id="note" class="padding-4 background-white col-12">
        <!--BOLDNESS OF A WORD --`extra` column in `general` WHERE `desc`=\"PackingNote\" for any non-capitalized words-->
        <span class='bold'>NOTE:</span>
        <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
            <span>
                 (fully capitalized words automatically become bold)
            </span>
            <span class="btn background-purple pull-right" style="padding: 2px 4px;">
                <aside data-parent="2" data-type="edit">
                    <i class="fas fa-edit"></i>
                    Edit
                </aside>
            </span>
            <br/>
            <div class="padding-2">
                <hr/>
            </div>
        <?php }
            //bold the phrases found in PackingNote[extra]
            $text=$row["content"];
            $bold=explode(":::", $row["extra"]);
            
            preg_match_all("/([A-Z]{2,})/", $text , $matches);
            foreach( $matches[1] as $match ) array_push($bold, $match);
            
            if($_SESSION["userLevel"] < $_userType["admin"]){
                $text=preg_replace("/[$]/", " <span class='fas fa-money-bill-alt'></span>", $text);
                foreach($bold as $search)
                    $text=preg_replace("/$search/", "<span class='bold'>$search</span>", $text);
            }
        ?>
        <div  <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="general" data-field="content" where-desc="PackingNote" data-type="editable"';?>><?php
            echo $text;
        ?></div>
    </div>
    <?php } ?>
</div>

<br/>
<div class="fa-lg padding-2 color-orange pointer underline underline-orange" id="">
    <span class="fas fa-map-marked-alt"></span>
    Park Information
    <span class="fa-lg fas fa-angle-double-up pull-right"></span>
</div>
<div class="background-orange padding-4">
    <div class="padding-4 horizontal-align" id="parkButtonsParent">
        <?php
            $parks=array();
            $result=mysqli_query($conn, "SELECT DISTINCT `parkID` FROM `parkInfo`");
            while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result))
                array_push($parks, $row["parkID"]);
            //icon array must be manually set
            $icon=["fab fa-fort-awesome", "fas fa-golf-ball", "fas fa-paw", "fas fa-film", "fas fa-umbrella-beach", "fas fa-film"];
            for($i=0; $i < count($parks); $i++){ ?>
                <!-- parkSwitch:nth-child (information.css)-->
                <div class="parkSwitch" data-location="<?php echo $parks[$i]; ?>" data-favicon="<?php echo ($i<count($icon))? $icon[$i] : ""; ?>">
                    <div class="btn btn-md padding-1">
                        <img src="images/information/parks/<?php echo $parks[$i]; ?>.png"/>
                    </div>
                </div>
        <?php } ?>
    </div>
    <div class='container padding-5 row col-xs-11 center-block' id="parkInformationContainer">
        <div class="color-white parkInfo text-left">
            <div class="text-center">
                <h4 class="underline inline-block bold text-center" style="padding-bottom: 3px; margin-top: 0px">
                    
                </h4>
            </div>
            <div data-subject="default" class="text-center">
                <i class="fas fa-hand-pointer fa-lg" style="vertical-align: 10%;"></i>
                <span class="bold" style="padding: 0px 5px">Select a Park to View Relevant Information</span>
                <i class="fas fa-hand-pointer fa-lg" style="vertical-align: 10%;"></i>
                <br/><br/>
            </div>
            <?php
                $subject=array();
                $result=mysqli_query($conn, "SELECT DISTINCT `subjectID` FROM `parkInfo`");
                while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result))
                    array_push($subject, $row["subjectID"]);
                //icon array must be manually set
                $icon=["fas fa-medkit", "fab fa-accessible-icon", "fas fa-door-closed", "fas fa-question-circle"];
                for($i=0; $i < count($subject); $i++){
            ?>
                <div class="display-none" data-subject="<?php echo $subject[$i]; ?>">
                    <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                        <aside data-parent="1" data-type="edit">
                            <i class="fas fa-edit"></i>
                        </aside>
                    <?php } ?>
                    <i class="<?php echo ($i<count($icon))? $icon[$i] : ""; ?> fa-lg" style="margin-left:2.5px"></i>
                    <span class="bold"></span>
                    <!-- where-id is changed in information.js -->
                    <div class="tab" <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="parkInfo" data-field="content" where-id="" data-type="editable"';?>>
                        
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <br/>
</div>