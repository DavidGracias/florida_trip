<div class="background-white">
    <br/><br/>
</div>
<footer class="background-blue color-white" id='footer'>
    <br/>
    <div class="row padding-4">
        <div class='col-xs-12 col-sm-4'>
            <h4>NAVIGATION</h4>
            <div class="row">
                <div class="center-block">
                    <div>
                        <a href='index.php'>Home</a>
                    </div>
                    <?php if($_SESSION["userLevel"] >=$_PAGES["finances"]){ ?>
                    <div>
                        <a href='index.php?finances'>Finances</a>
                    </div>
                    <?php }
                    if($_SESSION["userLevel"] >=$_PAGES["students"]){ ?>
                    <div>
                        <a href='index.php?students'>Students</a>
                    </div>
                    <?php }
                    if($_SESSION["userLevel"] >=$_PAGES["information"]){ ?>
                    <div>
                        <a href='index.php?information'>Information</a>
                    </div>
                    <?php }
                    if($_SESSION["userLevel"] >=$_PAGES["calendar"]){ ?>
                    <div>
                        <a href='index.php?calendar'>Calendar</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <hr class="col-xs-12 visible-xs"/>
        
        <div class='col-xs-12 col-sm-4' id="contacts">
            <h4>CONTACT</h4>
            <div class="contact row container-fluid">
                <?php
                    $gradYears=array();
                    $result=mysqli_query($conn, "SELECT DISTINCT `gradYear` FROM `trip` WHERE NOT `gradYear`=9999 ORDER BY `gradYear` desc");
                    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result))
                        array_push($gradYears, $row["gradYear"]);
                    
                    $nextTripYear=substr(nextTripYear($conn, true), 0, 4);
                    $result=mysqli_query($conn, "SELECT * FROM `admin` WHERE `gradYear`=9999 or `gradYear`='$nextTripYear' ORDER BY `gradYear` DESC");
                    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                        <div>
                            <h5 class="pointer">
                                <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                                    <aside data-parent="2" data-type="edit">
                                        <i class="fas fa-edit"></i>
                                    </aside>
                                <?php } ?>
                                
                                <a href='mailto:<?php echo $row["email"]; ?>' class="fas fa-envelope"></a>
                                <?php echo ucwords($row["fName"]." ".$row["mName"]." ".$row["lName"]); ?>
                                <span class="fa-lg fas fa-angle-double-down pull-right pointer"></span>
                            </h5>
                            <div class="container display-none" data-type="slideTarget">
                                <div>
                                    <?php echo (intval($row["gradYear"]) == 9999 )? "Trip Coordinator" : "Class of ".$row["gradYear"]." Sponsor"; ?>
                                </div>
                                <div>
                                    <a <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="admin" data-field="phone" where-adminID="'.$row["adminID"].'" data-type="editable"';?> class='pointer' href="tel:<?php echo preg_replace("/\D/", "", $row["phone"]); ?>"><?php echo $row["phone"]; ?></a>
                                </div>
                                <div class='vertical-align'>
                                    <span style="padding-right: 4.5px">Classroom:</span>
                                    <span <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="admin" data-field="classroom" where-adminID="'.$row["adminID"].'" data-type="editable"';?>><?php
                                        echo $row["classroom"];
                                    ?></span>
                                </div>
                            </div>
                        </div>
                    <?php }
                
                ?>
            </div>
        </div>
        
        <hr class="col-xs-12 visible-xs"/>
        
        <div class='col-xs-12 col-sm-4 pull-right' id="locations">
            <h4>LOCATIONS</h4>
            <div class="container-fluid row text-center">
                <?php
                    $prefix="Footer-Location-";
                    $result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc` LIKE \"$prefix%\" ");
                    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                        <div>
                            <h5><?php echo substr($row["desc"], strlen($prefix)); ?></h5>
                            <div>
                                <a target="_blank" href="https://maps.google.com/?q=<?php echo $row["content"]; ?>"><?php echo ucwords($row["content"]); ?></a>
                            </div>
                            <div>
                                <a href="tel:<?php echo preg_replace("/\D/", "", $row["extra"]); ?>"><?php echo $row["extra"]; ?></a>
                            </div>
                        </div>
                        <br/>
                    <?php } ?>
            </div>
        </div>
    </div>
    <div class="text-center padding-4">
        <span><?php
            if($funny) //heheheheehe
                echo "<i class='fas fa-egg'></i>, <i class='fas fa-egg'></i>, <i class='fas fa-egg'></i>, <i class='fas fa-egg'></i>, <i class='fas fa-egg'></i>, <i class='fas fa-egg'></i>, <i class='fas fa-egg'></i>, <i class='fas fa-egg'></i>";
            else
                echo "David Garcia, Sydney Borislow, Benjamin Lubas, Hana Kenworthy, Ashley Ajuz, Namita Rao, Jack Quinn, Allison Helferty";
            ?>. <?php echo date("Y"); ?>. <i class="far fa-copyright"></i></span><br/>
    </div>
    <br/>
</footer>