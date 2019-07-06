<!-- TRANSACTIONS -->
<div class="container-fluid" id='finances'>
    <?php //include_once("includes/modals/digitalReceipt.php"); ?>
    <!-------------------------------------------------------------- PROGRESS BAR START -------------------------------------------------------------->
    <?php if($_SESSION["userLevel"] == $_userType["student"] || $_SESSION["userLevel"] == $_userType["parent"]){
            $raised=0;
            $result=mysqli_query($conn, "SELECT * FROM `transactions` WHERE `studID`=".$_SESSION["id"]);
            while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result))
                $raised+=$row['amount'];
            
            $payments=array();
            $dates=array();
            $result=mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`='".$_SESSION["gradYear"]."'");
            if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
                $payments=[ $row['pay1'], $row['pay2'], $row['pay3'] ];
                $dates=[ $row['payDate1'], $row['payDate2'], $row['payDate3'] ];
            }
            $total=max(1, array_sum($payments) );
            $popover='data-toggle="popover" data-trigger="hover" data-placement="top" title="Total Payments:" data-html=true data-content="Percent: '. (($raised/$total < 1)? round($raised/$total*100) : 100 ).'%<br/>Raised: $'.number_format($raised).'"';
        ?>
        <div class="row">
            <h2 style="color: #449d44">
                Payments Progress Bar
            </h2>
            <div class="col-md-1"></div>
            <div class="col-xs-12 col-md-10 center-block">
                <div class="progress progress-bar-inverse" style="height: 40px; border-radius: 15px; width: 100%" <?php if( !($raised > 0) ) echo $popover; ?>>
                    <div class="progress-bar progress-bar-success progress-bar-striped active" <?php if($raised > 0) echo $popover; ?> style="width: 0%" data-width="<?php echo ($raised/$total < 1)? round($raised/$total*100) : 100; ?>">
                    </div>
                </div>
                <?php
                $cumulative=0;
                $col_total=12;
                for($i=0; $i < count($payments); $i++){
                    $col_width=round($payments[$i]/$total * 12);
                    if($col_width == 0)
                        continue;
                    else if($i !=count($payments)-1){
                        for($a=$i; $a < count($payments)-1; $a++){
                            if($col_total-$col_width == $a-$i && round($payments[$a+1]/$total) !=0)
                                $col_width-=1;
                        }
                    }
                    else $col_width=$col_total;
                    $col_total-=$col_width;
                ?>
                    <div class='progress-indicators no-pointer col-xs-<?php echo $col_width; ?> text-right'>
                        <span class="active pull-right <?php
                            if($raised > $cumulative+$payments[$i])
                                echo "btn-success";
                            else if(date("Y/m/d", strtotime('+7 days')) >=date("Y/m/d", strtotime($dates[$i])))
                                echo "btn-danger";
                            else if(
                                date("Y", strtotime($dates[$i])) == date("Y") ||
                                (date("m", strtotime($dates[$i])) < 8 && date("Y", strtotime($dates[$i]))-1== date("Y"))
                            )
                                echo "btn-warning";
                            else echo "btn-default";
                            ?>" data-toggle="popover" data-trigger="hover" data-placement="top" title="Payment <?php echo $i+1; ?> Date: " data-content="<?php echo date("F d, Y", strtotime($dates[$i])); ?>">
                            $<?php echo $cumulative+=$payments[$i]; ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-1"></div>
        </div>
        <br/>
    <?php } ?>
    <!--------------------------------------------------------------- PROGRESS BAR END --------------------------------------------------------------->
    
    <?php if($_SESSION["userLevel"] >= $_userType["sponsor"])
        include_once("includes/modals/newTransaction.php"); ?>
    <br/>
    <!------------------------------------------------------------- TRANSACTIONS ------------------------------------------------------------>
    <?php if($_SESSION["userLevel"] != $_userType["chaperone"] && $_SESSION["userLevel"] >= $_userType["student"]){ ?>
    <div class="container-fluid input-group vertical-align">
        <h2 style='margin-top:0px'> Transactions Log </h2>
        <div class="flex-grow input-group padding-3">
            <div class="input-group-btn">
                <div id='paySearchIcon' class="btn btn-default" data-type="slideable" data-parent="4">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input  id="paySearchBar" class="form-control" type="text" placeholder="Search.."/>
        </div>
    </div>
    <?php
        if($_SESSION['userLevel'] >= 3){ ?>
        <div class="small text-center padding-1">*In order to see added transactions, you must reload the page.</div>
    <?php } ?>
    
    <!--
    <div class="flex-grow input-group padding-3">
        <input  id="searchBar" class="form-control" type="text" placeholder="Search.."/>
        <div class="input-group-btn">
            
        </div>
    </div>
    -->
    <div class='paymentHistory container-fluid' style="max-height: 75vh; overflow-y: auto">
        <table id="transactionTable" class='table table-striped table-bordered stickyHeader'>
            <thead>
                <tr style="background-color: rgb(240, 240, 240)">
                    <?php 
                        $isStud = true; 
                        if($_SESSION["userLevel"] != $_userType["student"] && $_SESSION["userLevel"] != $_userType["parent"]) {
                            $isStud = false; 
                            echo "<th>Student</th>"; 
                        }
                    ?>
                    <!--<th>Payment ID</th>-->
                    <th>Amount Deposited</th>
                    <th id='pay_filter_th' style='min-width:175px'>Payment Type
                    <?php if(!$isStud) {
                        $content = "
                            <div name='payType' class='color-blue filterGroup'>
                                <div value='cash' class='btn select'>
                                    Cash
                                </div>
                                <div value='check' class='btn select'>
                                    Check
                                </div>
                                <div value='paypal' class='btn select'>
                                    PayPal
                                </div>
                                <div value='fr' class='btn select'>
                                    Fundraiser
                                </div>
                            </div>
                        "; ?>
                        <i class='fas fa-filter pointer' style='margin-left:5px;' data-toggle='popover' data-trigger='click' data-placement='top' title='Filter Payment Options' data-html='true' data-content="<?php echo $content; ?>"></i>
                    <?php } ?>
                    </th>
                    <th>Date Paid</th>
                    <!--<th>Status</th>-->
                </tr>
                
            </thead>
            <tbody>
                <?php if($_SESSION["userLevel"] >= $_userType["sponsor"]){ ?>
                <tr data-toggle="modal" data-target="#newTransactionModal">
                    <td colspan="4" class="color-blue pointer row" style="border-bottom: 0px">
                        <i class="fas fa-plus fa-lg col-xs-3" style="margin-top: 3.5px"></i>
                        <div class="col-xs-6">
                            Add New Transation
                        </div>
                        <i class="fas fa-plus fa-lg col-xs-3" style="margin-top: 3.5px"></i>
                    </td>
                </tr>
                <?php } ?>
                
                <?php $sql = "SELECT * FROM transactions t ";
                if($_SESSION["userLevel"] == $_userType["student"] || $_SESSION["userLevel"] == $_userType["parent"])
                    $sql .= "WHERE `studID`=".$_SESSION["id"]." ORDER BY `dateTime` DESC";
                else if($_SESSION["userLevel"] == $_userType["sponsor"])
                    $sql .= "INNER JOIN students s ON s.studID = t.studID WHERE s.gradYear='{$_SESSION['gradYear']}' ORDER BY s.gradYear DESC, t.dateTime DESC";
                else if($_SESSION["userLevel"] == $_userType["admin"])
                    $sql .= "INNER JOIN students s ON s.studID = t.studID ORDER BY s.gradYear DESC, t.dateTime DESC ";


                $result = mysqli_query($conn, $sql);
                while(mysqli_num_rows($result) > 0 && $row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='transactionListing'>";
                    if($_SESSION["userLevel"] !=$_userType["student"] && $_SESSION["userLevel"] != $_userType["parent"])
                        echo "<td>{$row['fName']} {$row['lName']}</td>";
                    echo "<td>$".$row["amount"]."</td>";
                    $type="";
                    switch( intval($row["type"]) ){
                        case 1: 
                            $type="<i class='fas fa-money-check text-primary'></i> Check - #".strtoupper($row["typeID"]);
                            $filterType = "check";
                            break;
                        case 2:
                            $type = "<i style='margin-top:-1px; margin-left: -2px' class='fas fa-piggy-bank color-pink fa-lg'></i> Fundraiser - ";
                            $filterType = "fr";
                            $fund = mysqli_query($conn, "SELECT * FROM `fundraisers` WHERE `id`='".$row["typeID"]."'");
                            if(mysqli_num_rows($fund) > 0 && $fundRow = mysqli_fetch_assoc($fund))
                                $type .= ucwords($fundRow["title"]);
                            else{
                                //THIS HAPPENS IF THE FUNDRAISER WAS DELETED -- WHAT SHOULD GO HERE
                                //MAYBE AN EDIT / SELECT for them to choose another fundraiser?? or leave it blank
                            }
                            break;
                        case 3: 
                            $type = "<i style='padding-left: 2.5px; padding-right:2px' class='fab fa-paypal fa-lg color-blue'></i> PayPal - @".$row["typeID"];
                            $filterType = "paypal";
                            break;
                        default: 
                            $type = "<i class='fas fa-money-bill-alt text-success'></i> Cash";
                            $filterType = "cash"; 
                    }
                    echo "<td class='collapse-td' name='payType' value='$filterType'>$type</td>";
                    echo "<td>".date("F d, Y",strtotime($row["dateTime"]))."</td>";
                    $datePaid=strtotime($row["dateTime"]);
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
    <br/>
    <?php } ?>
    <!-------------------------------------------------------------- TRANSACTIONS END ------------------------------------------------------------->
</div>

        <!-------------------------------------------------------------- PAYMENTS ------------------------------------------------------------->
<?php
    $result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc`=\"Finances-Payments\" ");
    if(mysqli_num_rows($result) > 0)
        $row=mysqli_fetch_assoc($result);
    if( !(strlen($row["content"]) > 0) )
        $row["content"]=getDefault("Finances-Payments", "content");
    if( !(strlen($row["extra"]) > 0) )
        $row["extra"]=getDefault("Finances-Payments", "extra");
?>
<div class="container-fluid color-white row flex-stretch paymentSmallBlock">
    <div class="padding-2 background-orange visible-xs-block visible-sm-block visible-md-inline-block visible-lg-inline-block" style="width: 50%">
        <h3 class="text-center">
            <span class="underline underline-white padding-1">How To Make Payments</span>
            <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                <span class="btn" style="padding: 1px 2px 1px 3px; margin: 0px 4px">
                    <aside data-parent="3" data-type="edit">
                        <i class="fas fa-edit"></i>
                    </aside>
                </span>
            <?php } ?>
        </h3>
        <div class="padding-4" <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="general" data-field="content" where-desc="Finances-Payments" data-type="editable"'; ?>><?php
            echo $row["content"];
        ?></div>
    </div>
    <div class="hidden-xs hidden-sm" style="width: 10px"></div>
    <div class="hidden-md hidden-lg" style="width: 100%; height: 5px"></div>
    <div class="padding-2 background-dark-blue visible-xs-block visible-sm-block visible-md-inline-block visible-lg-inline-block" style="width: 50%">
        <h3 class="text-center">
            <span class="underline underline-white padding-1">Paying with PayPal</span>
            <?php if($_SESSION["userLevel"] >=$_userType["admin"]){ ?>
                <span class="btn" style="padding: 1px 2px 1px 3px; margin: 0px 4px">
                    <aside data-parent="3" data-type="edit">
                        <i class="fas fa-edit"></i>
                    </aside>
                </span>
            <?php } ?>
        </h3>
        <div class="padding-4" <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="general" data-field="extra" where-desc="Finances-Payments" data-type="editable"';?>><?php
            echo $row["extra"];
        ?></div>
        <br/>
         <form style='display:block; text-align:center' action="https://www.paypal.com/myaccount/transfer/send" target="_blank">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        </form>
        <a id="" href="https://www.paypal.com/myaccount/transfer/send" target="_self" class="pypl-btn mpp-btn product-hero__cta" data-pa-click="PrdctHero-PrmryCTA-Send Money
" role="button" pa-marked="1">Send Money
</a>

            <div class="text-center padding-2"><a class="color-white a" href="files/paypal_announcement.pdf" target="_blank">View Directions for paying with PayPal</a></div>
        </div>
</div>
<br/>
    <!-------------------------------------------------------------- PAYMENTS END ------------------------------------------------------------->

<!-- FUNDRAISERS -->
    <!------------------------------------------------------------ FUNDRAISERS TABLE START ----------------------------------------------------------->
<div class="content">
    <!--col-xs-8 col-md-10 col-xs-push-2 col-md-push-1-->
    <h2 class="color-purple" style="margin-left:80px">
        Fundraisers
    </h2>
    <div class="clear"></div>
    <div class="row vertical-align flex-nowrap">
        <div class="col-xs-2 col-md-1 text-center">
            <i class="fas fa-angle-double-left pointer fa-lg background-purple color-white" id="left-button"></i>
        </div>
        <div class="color-white background-purple col-xs-8 col-md-10" id="fundraisers" style="overflow: hidden; border-left: 8px; border-right: 8px">
            <div id="scrollDiv" class="margin-0 padding-0 flex-stretch">
                <?php $x = 0;
                    if ($_SESSION['userLevel'] >= $_userType['sponsor']) { $x++ ?>
                    <div id="newFundContainer" style="margin-left: 0px; margin-right: 0px;" class="color-black fundraiserTable top display-inline pointer">
                        <div class="h4 top center-block background-white">
                            Create New </br>Fundraiser
                        </div>
                        <div>
                            <i class="fas fa-plus-circle center-block fa-7x color-blue" id="addFundraiser"></i>
                        </div>
                    </div>
                    <!-- Loop through and display all the fundraisers -->
                <?php }
                        $result=mysqli_query($conn,"SELECT * FROM fundraisers");
                        while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                            <div class='text-center color-black background-white fundraiserTable display-inline' data-id='<?php echo $row["id"]; ?>' style="margin<?php echo ($x++ > 0)? "-right": "-left: 0px; margin-right"; ?>: 0px">
                                <div style="min-height: 60%" class="vertical-align">
                                    <img class='fundraiserImage' src='images/fundraisers/<?php echo (strlen($row["picRef"]) > 0)? $row["picRef"] : 0; ?>.png'/>
                                </div>
                                <div class='fundraiserTitle h4'>
                                    <?php echo ucwords($row["title"]); ?>
                                </div>
                                <div class="pointer padding-3 seeMoreContainer" slideable="false">
                                    <span class='seeMore'>See More</span>
                                    <span class='fa-lg fas fa-angle-double-down pull-right' style="padding-bottom:-5px"></span>
                                </div>
                            </div>
                        <?php } ?>
            </div>
            <div class="clear"></div>
            <br/>
            <!-- This is the dropdown thing -->
            <div id="Finances-SeeMore" class="display-none">
                <br/>
                <?php if ($_SESSION['userLevel'] >=$_userType['sponsor']){ ?>
                <div id="changeFund" class="pull-right">
                    <aside data-parent="2" data-type="" class="delete">
                        <i class="fas fa-times"></i>
                        Delete
                    </aside>
                    <div style="width: 10px; display: inline-block"></div>
                    <aside data-parent="2" data-type="edit">
                        <i class="fas fa-edit"></i>
                        Edit
                    </aside>
                </div>
                <div id="submitFund" data-gradYear="<?php echo $_SESSION["gradYear"]; ?>" class="pull-right background-blue color-white btn bold padding-2 display-none addingFund">
                    Submit
                </div>
                <div style="margin-right: 10px; margin-bottom: 5px" class="pull-right color-white btn btn-danger bold padding-2 display-none addingFund" onclick="$('#Finances-SeeMore').slideUp();">
                    Cancel
                </div>
                <div style="clear: both"></div>
                <br/>
                <div class="addingFund padding-4 input-group vertical-align" style="margin-top: -20px; margin-bottom: 5px">
                    <input type="file" class="file-upload" style="display: none"/>
                    <div class="upload-button pointer btn btn-primary">
                        <i class="fa-lg fas fa-file-image"></i>
                        <span class="bold">Upload Image</span>
                    </div>
                    <label class="control-label box-title" style="margin-left: 10px">TITLE:</label>
                    <div class="content flex-grow" style="margin: 15px"  data-field="title" <?php if($_SESSION["userLevel"] >= $_userType["sponsor"]) echo 'data-table="fundraisers" where-id="" data-type="editable"'?>></div>
                </div>
                <?php } ?>
                <div class="col-xs-12 col-lg-4">
                    <div class="info-block">
                        <section class="file-marker">
                            <div>
                                <div class="background-purple box-title">DESCRIPTION</div>
                                <div class="outline">
                                    <div class="content" data-field="description" <?php if($_SESSION["userLevel"] >= $_userType["sponsor"]) echo 'data-table="fundraisers" where-id="" data-type="editable"';?>></div>
                                    <div class="content" data-field="pdfLink" <?php if($_SESSION["userLevel"] >= $_userType["sponsor"]) echo 'data-table="fundraisers" where-id="" data-type="editable"';?>></div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <br/>
                </div>
                <div class="col-xs-6 col-lg-4">
                    <div class="info-block">
                        <section class="file-marker">
                            <div>
                                <div class="background-purple box-title">DATES</div>
                                <div class="outline">
                                    <h4>Start</h4>
                                    <div class="content" data-field="dateStart" <?php if($_SESSION["userLevel"] >= $_userType["sponsor"]) echo 'data-table="fundraisers" where-id="" data-type="editable"';?>></div>
                                    
                                    <h4>End</h4>
                                    <div class="content" data-field="dateEnd" <?php if($_SESSION["userLevel"] >= $_userType["sponsor"]) echo 'data-table="fundraisers" where-id="" data-type="editable"';?>></div>
                                    
                                    <h4>Pickup</h4>
                                    <div class="content" data-field="datePickup" <?php if($_SESSION["userLevel"] >= $_userType["sponsor"]) echo 'data-table="fundraisers" where-id="" data-type="editable"';?>></div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <br/>
                </div>
                <div class="col-xs-6 col-lg-4">
                    <div class="info-block">
                        <section class="file-marker">
                            <div>
                                <div class="background-purple box-title">CONTACT</div>
                                <div class="outline">
                                    <h4>Phone</h4>
                                    <div class="content" data-field="contactPhone" <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="fundraisers" where-id="" data-type="editable"';?>></div>
                                    
                                    <h4>Email</h4>
                                    <div>
                                        <a class="content a color-white" data-field="contactEmail" <?php if($_SESSION["userLevel"] >=$_userType["sponsor"]) echo 'data-table="fundraisers" where-id="" data-type="editable"';?>>
                                            
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
        <div class="col-xs-2 col-md-1 text-center">
            <i class="fas fa-angle-double-right pointer fa-lg background-purple color-white" id="right-button"></i>
        </div>
    </div>
</div>
<script src="scripts/filter.js"></script>
<script>
    $(document).on('click', '#paySearchIcon', function(){
        $('#paySearchBar').focus();
    });
</script>