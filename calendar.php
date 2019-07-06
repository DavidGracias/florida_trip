
<link href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css' rel='stylesheet'>

<div class='row Full-Cal'>
    
    <!-- SIDEBAR -->
    <div class='col-xs-12 col-md-4 Sidebar'>
        <div class='event-container padding-4' id='events'>
            <div class='vertical-align flex-nowrap' style='justify-content: space-between; padding: 10px 0px'>
                <h2 class="margin-0">Events</h2>
                <?php if($_SESSION["userLevel"] == $_userType["admin"]){
                    include("includes/modals/LinkCalModal.php"); ?>
                    <div class="text-center">
                        <div class='btn btn-blue bold' data-toggle="modal" data-target="#CalModal">Link Calendar</div>
                    </div>
                <?php } ?>
            </div>
            <div id='sideTitle'> 
                <h4 id="eventDayName" class="padding-2"><?php echo date("d"); ?></h4>
                <div id='weekDay'><?php echo date("l"); ?></div>
                
                <br/>
            </div>     
            
           <div class="displayEvent" id="sideEvents"></div>
        </div>
        
    </div>
    
    <!--MAIN CALENDAR-->
    <div class='col-xs-12 col-md-8 Calendar'>
        
        <!-- HEADER -->
        <div class='background-header'>
            <div class='cal-header vertical-align'>
                <i class='fas fa-angle-double-left fa-lg pointer padding-4' id='leftArrow'></i>
                <div class='cal-header-title text-center flex-grow'>
                    <h1 id='month-name' style="margin-top: 0px"><?php echo date("F Y"); ?></h1>
                    <h3 id='todayDayName' class="margin-0"><span class="pointer a" id="changeToToday">Today</span> is <?php echo date("l, M jS"); ?></h3>
                    
                </div>
                <i class='fas fa-angle-double-right fa-lg pointer padding-4' id='rightArrow'></i>
            </div>
        </div>

        <div class='cal-content'>
            <div id='cal-table' class='cal-cells'>
                <div class='Calrow'>
                        <div class="col">Sun</div>
                        <div class='col left'>Mon</div>
                        <div class='col left'>Tue</div>
                        <div class='col left'>Wed</div>
                        <div class='col left'>Thu</div>
                        <div class='col left'>Fri</div>
                        <div class='col left'>Sat</div>
                </div>
            </div>
            <div id="table-body-container">
                <div id="table-body">
    
                </div>
            </div>
        </div>
    </div>


</div>
<?php include("scripts/CalFunctions.php")?>
