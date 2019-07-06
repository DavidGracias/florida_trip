<?php
$isStudent=$_SESSION["userLevel"] == $_userType["student"];
if($isStudent)
    $result=mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`=".$_SESSION["gradYear"]);
$isStudent=$isStudent && mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result);

if($isStudent && $row["displayAssignments"] == 1){ ?>
    <div class="container-fluid row color-white background-darkest-blue" style="padding: 15px 5px">
        <h2 class="padding-3 margin-0 color-red vertical-align flex-nowrap">
            <i class="fas fa-exclamation-triangle fa-sm"></i>
            <div class="flex-grow text-center">IMPORTANT INFORMATION</div>
            <i class="fas fa-exclamation-triangle fa-sm"></i>
        </h2>
        <div style="padding-top: 15px; font-size: 1.2em">
            
            <div class="flex-nowrap" style="justify-content: space-evenly">
                <div class="vertical-align flex-nowrap">
                    <i class="fas fa-clipboard-list"></i>
                    <div class="padding-2 flex-grow">
                        <span class="a pointer" data-dismiss="modal" data-toggle="modal" data-target="#itineraryModal">View Itinerary</span>
                    </div>
                </div>
                <div class="vertical-align flex-nowrap">
                    <?php
                    $result=mysqli_query($conn, "SELECT * FROM `form` WHERE `studID`=".$_SESSION["id"]);
                    if(mysqli_num_rows($result) == 0){ ?>
                        <i class="fas fa-hourglass-half color-orange"></i>
                        <div class="padding-2 flex-grow">
                            <span class="a pointer" data-toggle="modal" data-target="#medicalFormModal">Fill Medical Form</span>
                        </div>
                        <?php include_once("includes/modals/medicalInformationForm.php");
                    }
                    else{ ?>
                        <i class="fas fa-check color-green"></i>
                        <div class="padding-2 flex-grow">
                            <span class="a pointer" data-toggle="modal" data-target="#medicalInfoModal">View Medical Information</span>
                        </div>
                        <?php include_once("includes/modals/medicalInformation.php");
                    } ?>
                </div>
                <div class="vertical-align flex-nowrap">
                            <?php
                            $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`=".$_SESSION["id"]);
                            $row=mysqli_fetch_assoc($result);
                            if($row["seniorTripContract"] == 0){ ?>
                                <i class="fas fa-hourglass-half color-orange"></i>
                                <div class="padding-2 flex-grow">
                                    <span class="a pointer" data-toggle="modal" data-target="#seniorTripContractModal">Sign Senior Trip Contract</span>
                                </div>
                                <?php include_once("includes/modals/seniorTripContract.php");
                            }
                            else{ ?>
                                <i class="fas fa-check color-green"></i>
                                <div class="padding-2 flex-grow">
                                    <a class="a color-white" href="files/senior_trip_contract.pdf" target="_blank">View Senior Trip Contract</a>
                                </div>
                            <?php } ?>
                        </div>
            </div>
            <div class="text-center margin-5">
                <a class="btn btn-primary" href="index.php?assignments">
                    Roommate Assignments
                </a>
            </div>
        </div>
    </div>
<br/>
<?php }

    if($_SESSION["userLevel"] == $_userType["admin"]){ ?>
    <div class="container-fluid row color-white padding-4" style="background-color: #2d3774;">
        <h2 class="padding-3 margin-0 vertical-align">
            <div class="vertical-align">
                Announcement
                <div style="font-size:.65em; margin-left: 20px"  data-toggle="modal" data-target="#announcementModal">
                    (<span class="a display-online pointer" >Preview</span>)
                </div>
            </div>
            <aside data-parent="2" data-type="edit">
                <i class="fas fa-edit"></i>
                Edit
            </aside>
        </h2>
        <div class="col-xs-12 color-blue text-center padding-2" style="font-size: 1.2em;">
            If there is any content below, students will see an announcement pop-up the next time they log in:
        </div>
        <div style="background-color: #47518E;" class="col-xs-12 tab padding-4" data-table="general" data-field="content" where-desc="announcement" data-type="editable"><?php
                $result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc`=\"announcement\"");
                $row=mysqli_fetch_assoc($result);
                echo $row["content"];
        ?></div>
    </div>
    <br/>
<?php } ?>
<div class="container-fluid row background-purple color-white padding-4">
    <div class="col-xs-12 col-sm-5 col-sm-push-7 margin-0">
        <h2 class="text-center">
            Countdown to Disney!
        </h2>
        <div>
            <?php
                include_once("includes/countdown.php");
            ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-7 col-sm-pull-5 row">
        <h2 class="padding-3 margin-0 vertical-align">
            Introduction
            <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                <aside data-parent="2" data-type="edit">
                    <i class="fas fa-edit"></i>
                    Edit
                </aside>
            <?php } ?>
        </h2>
        <div class="col-xs-12 tab" <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="general" data-field="content" where-desc="Intro" data-type="editable"';?>><?php
                $result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc`=\"Intro\"");
                $row=mysqli_fetch_assoc($result);
                echo (strlen($row["content"]) > 0)? $row["content"] : getDefault("Intro", "");
        ?></div>
    </div>
</div>
<br/>
<div class="container-fluid row background-orange color-white vertical-align padding-4" id="FAQ">
    <div class="hidden-xs col-sm-3 col-md-2">
        <img src="images/home/lionKing.png" class="img-responsive" id="FAQImage"/>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 row">
        <h2 class="padding-3" style="margin: 10px 5px;">
            Frequently Asked Questions
        </h2>
        <div class="col-xs-12 <?php if($_SESSION["userLevel"]==$_userType["student"]) echo "tab"; ?>">
            <!--Creating New Categories-->
            <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]){ ?>
                <div class="panel panel-default faq-new-category" style="margin-bottom: 10px">
                    <div class="panel-heading background-white pointer bold color-blue" >
                        Create New Category
                        <span class="fas fa-plus pull-right" style="margin-top:4.5px"></span>
                    </div>
                    <div class="display-none container-fluid">
                        <div class="input-group padding-4">
                            <span class="input-group-addon bold background-blue color-white">
                                Category:
                            </span>
                            <input type="text" class="form-control" name="category" placeholder="Category...">
                        </div>
                        <div>
                            <div class="btn btn-primary pull-right">Add</div>
                        </div>
                        <br/><br/>
                    </div>
                </div>
            <?php }
            $sql="SELECT DISTINCT `category` FROM `faq` WHERE NOT `answer`=''";
            $distinct=mysqli_query($conn, $sql);
            while(mysqli_num_rows($distinct) > 0 && $categoryRow=mysqli_fetch_assoc($distinct)){ ?>
                <div class="panel panel-default FAQ-category" style="margin-bottom: 10px">
                    <div class="panel-heading background-white pointer bold" data-function="FAQHeader">
                        <span><?php echo ucwords($categoryRow["category"]); ?></span>
                        <span class="fa-lg fas fa-angle-double-down pull-right" style="margin-top:4.5px"></span>
                    </div>
                    <div class="display-none">
                    <!--Creating New Questions-->
                    <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]){ ?>
                        <div class="faq-new-question panel-body color-black padding-0">
                            <div class="pointer color-blue" style="padding:15px">
                                Create New Question
                                <span class="fas fa-plus pull-right" style="margin-top:4.5px"></span>
                            </div>
                            <div class="display-none container-fluid">
                                <hr/>
                                <div class="input-group padding-4">
                                    <span class="input-group-addon bold background-blue color-white">
                                        Q:
                                    </span>
                                    <input type="text" class="form-control" name="question" placeholder="Question...">
                                </div>
                                <div class="input-group padding-4">
                                    <span class="input-group-addon bold background-blue color-white">
                                        A:
                                    </span>
                                    <input type="text" class="form-control" name="answer" placeholder="Answer...">
                                </div>
                                <div>
                                    <div class="btn btn-primary pull-right" data-category="<?php echo strtolower($categoryRow["category"]); ?>">Add</div>
                                </div>
                                <br/><br/>
                            </div>
                        </div>
                    <?php }
                    $result=mysqli_query($conn, "SELECT * FROM `faq` WHERE `category`='".$categoryRow['category']."' AND NOT `answer`='' ");
                    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                        <div class="faq-questions panel-body color-black padding-0 vertical-align flex-nowrap" data-type='deleteable'>
                            <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]){ ?>
                            <div style="height: 100%; margin: 0px;" class="top pull-left padding-3 vertical-align flex-nowrap" data-type="slideable" data-target='[data-type="slideTarget"]' data-parent="1">
                                <span class="top btn padding-1">
                                    <aside data-parent="3" data-type="delete">
                                        <i class="fas fa-times"></i>
                                    </aside>
                                </span>
                                <span class="top btn background-purple" style="padding: 1px 2px 1px 3px; margin: 0px 4px">
                                    <aside data-parent="3" data-type="edit">
                                        <i class="fas fa-edit"></i>
                                    </aside>
                                </span>
                            </div>
                            <?php } ?>
                            <div class="flex-grow">
                                <div class="pointer flex-start flex-nowrap container-fluid" style="padding:15px;">
                                    <span class="top bold" style="padding-right: 4px">Q: </span>
                                    <span class="flex-grow top" <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="faq" data-field="question" where-id="'.$row["id"].'" data-type="editable"';?>><?php
                                        echo $row["question"];
                                    ?></span>
                                    <span class="fa-lg fas fa-angle-double-down pull-right padding-2" style="margin-top:4.5px"></span>
                                </div>
                                <div class="display-none" data-type="slideTarget">
                                    <hr/>
                                    <div class="no-pointer tab flex-start flex-nowrap" style="padding:15px">
                                        <span class="top bold" style="padding-right: 4px">A: </span>
                                        <span class="flex-grow top tab-off" <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="faq" data-field="answer" where-id="'. $row["id"] .'" data-type="editable"';?>><?php
                                            echo $row["answer"];
                                        ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>