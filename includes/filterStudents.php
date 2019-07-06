<div class="col-sm-10 col-sm-push-1 display-none" id="filterStudentsDiv">
    <div class="popover bottom bottomArrowContainer pull-right">
        <div class="arrow"></div>
    </div>
    <div class="container-fluid background-white color-blue border-radius clear" style="margin-bottom: 20px">
        <div>
            <div class="pull-right padding-2 margin-4 border-radius no-pointer" style="background-color: #EFEFEF">
                <h5 class="display-inline bold">Key: </h5>
                <div class="btn selected padding-2">Selected</div>
                <div class="btn unselected padding-2">Unselected</div>
            </div>
            <div name='gradYear' class="filterGroup color-blue">
                <h4>Graduation Year</h4>
                <?php 
                    if($_SESSION['userLevel']==$_userType['chaperone']){
                        $result = mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`=$nextTripYear");
                    }
                    else if($_SESSION['userLevel']==$_userType['sponsor']){
                        $result = mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`=".$_SESSION['gradYear']);
                    }
                    else{
                    $result = mysqli_query($conn, "SELECT * FROM `trip` WHERE NOT `gradYear`=9999");
                    }
                    while(mysqli_num_rows($result) > 0 && $row = mysqli_fetch_assoc($result)){
                        if($counter++ == 0)
                            echo "<div value='".$row['gradYear']."' class='btn select active'>";
                        else
                            echo "<div value='".$row['gradYear']."' class='btn select'>";
                            echo $row["gradYear"];
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
        <hr/>
        <div name='gender' class="color-blue filterGroup">
            <h4>Gender</h4>
            <div value='0' class="btn select active">
                Male
            </div>
            <div value='1' class="btn select active">
                Female
            </div>
            <div value='2' class="btn select active">
                Unassigned / Other
            </div>
        </div>
        <hr/>
        <div name='forms' class="color-blue filterGroup">
            <h4>Forms</h4>
            <div value='1' class="btn select active">
                Completed
            </div>
            <div value='0' class="btn select active">
                Missing
            </div>
        </div>
        <hr/>
        <div name="balance" class="color-blue">
            <h4>Payments</h4>
            <div value='0' class="btn select" data-type='inactive'>
                Completed
            </div>
            <div value='1' class="btn select vertical-align">
                <span style="padding-right: 2.5px">Greater Than</span>
                $<input type="number" class="flex-grow" placeholder="__.__"/>
            </div>
            <div value='-1'class="btn select vertical-align">
                <span style="padding-right: 2.5px">Less Than</span>
                $<input type="number" class="flex-grow" placeholder="__.__"/>
            </div>
        </div>
        <hr/>
        <div name='rooms' class="color-blue filterGroup">
            <h4>Rooms</h4>
            <div value='0' class="btn select active">
                No Room
            </div>
            <div value='1' class="btn select active">
                1/4
            </div>
            <div value='2' class="btn select active">
                2/4
            </div>
            <div value='3' class="btn select active">
                3/4
            </div>
            <div value='4' class="btn select active">
                4/4
            </div>
        </div>
        <hr/>
        <div class="btn btn-danger margin-3 pull-right" data-type="clear">Show All</div>
    </div>
</div>
<script src="scripts/filter.js"></script>