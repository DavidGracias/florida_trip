<div id="profile" data-id='<?php echo $_SESSION["id"]; ?>'>
    <h2>
        <i class="fas fa-users"></i> Profile
    </h2>
    <div class="desc">
        ANY CHANGES MADE HERE WILL CHANGE THROUGHOUT THE SITE<br/>
        SAVE TO COMMIT CHANGES TO THE DATABASE
    </div>
    <br/>
    <form data-table="admin" where-adminID="<?php echo $_SESSION["id"]; ?>">
        <div class="col-xs-12 padding-0 input-group">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Name
                </span>
            </div>
            <div class="flex-grow">
                <input type="text" class="input col-xs-4" name="fName" placeholder="First"/>
                <input type="text" class="input col-xs-4" name="mName" placeholder="Middle"/>
                <input type="text" class="input col-xs-4" name="lName" placeholder="Last"/>
            </div>
        </div>
        <br/>
        
        <div class="col-xs-12 padding-0 input-group">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Email
                </span>
            </div>
            <div class="flex-grow">
                <input type="text" class="form-control col-xs-12" name="email" placeholder="email@staff.colonialsd.org"/>
            </div>
        </div>
        <br/>
        
        <div class="col-xs-12 col-sm-4 padding-0 input-group pull-left">
            <div class="input-group-addon background-blue color-white">
                <span class="visible-sm input-group-text">
                    Class
                </span>
                <span class="hidden-sm input-group-text">
                    Classroom
                </span>
            </div>
            <div class="flex-grow">
                <input type="text" class="form-control col-xs-12" name="classroom" placeholder="X##"/>
            </div>
        </div>
        <div class="col-xs-12 visible-xs" style="height: 20px"></div>
        
        <div class="col-xs-12 col-sm-7 col-sm-offset-1 padding-0 input-group pull-left">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Phone
                </span>
            </div>
            <div class="flex-grow">
                <input type="text" class="form-control col-xs-12" name="phone" placeholder="(123) 456-7890 x1234"/>
            </div>
        </div>
        
        <div class="col-xs-12">
            <br/><br/>
            <button value="submit" class="btn background-green color-white pull-right">Save</button>
            <div class="clear"><br/></div>
            <div style="display: grid">
                <div class="alert alert-success padding-4" style="opacity: 0; grid-row: 1; grid-column: 1;">
                    <span class="bold">Success!</span> Your Information and Updates were Saved Successfully!
                </div>
                <div class="alert alert-danger padding-4" style="opacity: 0; grid-row: 1; grid-column: 1;">
                    <span class="bold">Warning!</span> We Were Unable to Save Your Changes, Please Try Again Later!
                </div>
            </div>
        </div>
         <!--style="position: absolute; bottom: 0; right: 0"-->
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#userFunctions").on('show.bs.modal', function(){
            /* PROFILE */
            $.ajax({
                url:"scripts/connection.php?getFrom.php",
                type:"POST",
                data: {
                    table:"admin",
                    where: true,
                    adminID: $("#userFunctions #profile").attr("data-id"),
                },
                success:function(response){
                    var row=response.split("ENDOFROW");
                    var cols=row[0].split("\n");
                    var target=[
                        "fName",
                        "mName",
                        "lName",
                        "email",
                        "classroom",
                        "phone",
                    ];
                    for(var y=0; y < cols.length; y++){ //each column
                        var dict=cols[y].split(":::"); //array of length 2
                        if(target.includes(dict[0]))
                            $("#profile [name='"+dict[0]+"']").val(dict[1]);
                    }
                },
            });
        });//end of userFunctions modal.show
    });
</script>

<div id="trip" data-gradYear="<?php echo $_SESSION["gradYear"]; ?>">
    <h2>
        <i class="fas fa-graduation-cap"></i> Trip - Class of <span class="content"></span>
    </h2>
    <div class="desc">
        ANY CHANGES MADE HERE WILL CHANGE THROUGHOUT THE SITE<br/>
        SAVE TO COMMIT CHANGES TO THE DATABASE
    </div>
    <br/>
    <form data-table="trip" where-gradYear="<?php echo $_SESSION["gradYear"]; ?>">
        <div class="col-xs-12 padding-0 input-group">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Payment 1:
                </span>
            </div>
            <div class="flex-grow">
                <input type="number" class="input col-xs-6" name="pay1" placeholder="$680"/>
                <input type="text" class="input col-xs-6 datepicker" name="payDate1" placeholder="YYYY/MM/DD"/>
            </div>
        </div>
        <div class="col-xs-12" style="height: 7.5px"></div>
        
        <div class="col-xs-12 padding-0 input-group">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Payment 2:
                </span>
            </div>
            <div class="flex-grow">
                <input type="number" class="input col-xs-6" name="pay2" placeholder="$600"/>
                <input type="text" class="input col-xs-6 datepicker" name="payDate2" placeholder="YYYY/MM/DD"/>
            </div>
        </div>
        <div class="col-xs-12" style="height: 7.5px"></div>
        
        <div class="col-xs-12 padding-0 input-group">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Payment 3:
                </span>
            </div>
            <div class="flex-grow">
                <input type="number" class="input col-xs-6" name="pay3" placeholder="$600"/>
                <input type="text" class="input col-xs-6 datepicker" name="payDate3" placeholder="YYYY/MM/DD"/>
            </div>
        </div>
        <br/>
        
        <div class="col-xs-12 padding-0 input-group">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Florida Start:
                </span>
            </div>
            <div class="flex-grow">
                <input type="text" class="input col-xs-6 datepicker" name="floridaStart" placeholder="YYYY/MM/DD"/>
                <input type="text" class="input col-xs-6" name="floridaStart-time" placeholder="2:20 PM"/>
            </div>
        </div>
        <div class="col-xs-12" style="height: 7.5px"></div>
        <div class="col-xs-12 padding-0 input-group">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Florida End:
                </span>
            </div>
            <div class="flex-grow">
                <input type="text" class="input col-xs-6 datepicker" name="floridaEnd" placeholder="YYYY/MM/DD"/>
                <input type="text" class="input col-xs-6" name="floridaEnd-time" placeholder="11:59 PM"/>
            </div>
        </div>
        <div class="col-xs-12" style="height: 7.5px"></div>
        
        <div class="col-xs-12">
            <br/><br/>
            <button value="submit" class="btn background-green color-white pull-right">Save</button>
            <div class="clear"><br/></div>
            <div style="display: grid">
                <div class="alert alert-success padding-4" style="opacity: 0; grid-row: 1; grid-column: 1;">
                    <span class="bold">Success!</span> Your Information and Updates were Saved Successfully!
                </div>
                <div class="alert alert-danger padding-4" style="opacity: 0; grid-row: 1; grid-column: 1;">
                    <span class="bold">Warning!</span> We Were Unable to Save Your Changes, Please Try Again Later!
                </div>
            </div>
        </div>
         <!--style="position: absolute; bottom: 0; right: 0"-->
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#userFunctions").on('show.bs.modal', function(){
            /* TRIP */
            $("#trip h2 .content").text($("#trip").attr("data-gradYear"));
            $.ajax({
                url:"scripts/connection.php?getFrom.php",
                type:"POST",
                data: {
                    table:"trip",
                    where: true,
                    gradYear: $("#userFunctions #trip").attr("data-gradYear"),
                },
                success:function(response){
                    var row=response.split("ENDOFROW");
                    var cols=row[0].split("\n");
                    var target=[
                        "pay1",
                        "payDate1",
                        "pay2",
                        "payDate2",
                        "pay3",
                        "payDate3",
                        "floridaStart",
                        "floridaEnd",
                    ];
                    for(var y=0; y < cols.length; y++){ //each column
                        var dict=cols[y].split(":::"); //array of length 2
                        if(target.includes(dict[0])){
                            if($("#trip [name='"+dict[0]+"']").hasClass("datepicker")){
                                var date=dict[1].split(" ");
                                date[0]=date[0].split("-").join("/");
                                $("#trip [name='"+dict[0]+"']").val(date[0]);
                                if($("#trip [name='"+dict[0]+"-time']").length > 0){
                                    //12:00:00 -> 12, 00
                                    date[1]=date[1].substring(0, 5);
                                    var time=date[1].split(":");
                                    var meridiem=(Math.floor(time[0]/12) == 0)? "AM" : "PM";
                                    time[0]=time[0]%12;
                                    if(time[0] == 0) time[0]+=12;
                                    $("#trip [name='"+dict[0]+"-time']").val(time[0]+":"+time[1]+" "+meridiem);
                                }
                            }
                            else
                                $("#trip [name='"+dict[0]+"']").val(dict[1]);
                        }
                    }
                },
            });
        });//end of userFunctions modal.show
    });
</script>

<div id="itinerary" data-=''>
    <h2>
        <i class="fas fa-clipboard-list"></i> Itinerary
    </h2>
    <div class="desc">
        
    </div>
    <br/>
    <div class=" fa-sm">
        
        <input type="file"/>
        <div class="btn btn-primary padding-3" data-toggle="modal" data-target="#itineraryModal">
            Open Itinerary
            
        </div>
        <h3>Add Event</h3>
        <div id="addEventForm">
            <div class="col-xs-12 col-sm-7 padding-3 input-group pull-left">
                <div class="input-group-addon background-blue color-white">
                    <span class="input-group-text">
                        Date
                    </span>
                </div>
                <div class="flex-grow">
                    <input type="text" id="newEventDate" class="datepicker form-control col-xs-12" name="date" placeholder="YYYY-MM-DD"/>
                </div>
            </div>
            <div class="col-xs-12 col-sm-7 padding-3 input-group pull-left">
                <div class="input-group-addon background-blue color-white">
                    <span class="input-group-text">
                        Time
                    </span>
                </div>
                <div class="flex-grow">
                    <input type="text" id="newEventTime" class="form-control col-xs-12" name="time" placeholder="HH:MM:SS"/>
                </div>
            </div>
            <div class="col-xs-12 col-sm-7 padding-3 input-group pull-left">
                <div class="input-group-addon background-blue color-white">
                    <span class="input-group-text">
                        Description
                    </span>
                </div>
                <div class="flex-grow">
                    <input type="text" id="newEventDesc" class="form-control col-xs-12" name="eventDesc" placeholder="Description"/>
                </div>
            </div>
            </br></br>
            <div style="margin-top:30px" class='pull-right btn btn-md btn-success' id="addEvent">Save</div>
            
        </div>
    </div>
</div>

<div id="assignments" data-=''>
    <h2>
        <i class="fas fa-"></i> Assignments
    </h2>
    <div class="desc">
        Release the following information to Students to complete / view
    </div>
    <br/>
    <form data-table="trip" where-gradYear="<?php echo $_SESSION["gradYear"]; ?>">
        </br></br>
        <h3 style="color: gray" class="vertical-align">
            <div class="color-black flex-grow">
                Control Panel
            </div>
            <?php 
                $result = mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`='".$_SESSION["gradYear"]."'");
                $row = mysqli_fetch_assoc($result);
                if ($row['displayAssignments'] == 0){
                    $show = false;
                }
                else {
                    $show = true;
                }
            ?>
            <label class="switch">
                <input id="displayAssignments" data-id="<?php echo $_SESSION['gradYear']; ?>" type="checkbox" name="displayAssignments" <?php if($show){ echo "checked";} else { echo "unchecked";} ?>>
                <span class="slider round"></span>
            </label>
        </h3>
        <div class="background-blue controlPanel padding-4" style="border-radius:30px; background-color:#C8CBCC;">
            <div class="row color-white padding-4" style="font-size: 1.1em">
                <div class="col-xs-6 vertical-align flex-nowrap padding-4">
                    <i class="fa-lg fas fa-clipboard-list" style="padding-right: 5px"></i>
                    Itinerary
                </div>
                <div class="col-xs-6 vertical-align flex-nowrap padding-4">
                    <i class="fa-lg fas fa-notes-medical" style="padding-right: 5px"></i>
                    Medical Form
                </div>
                <div class="col-xs-6 vertical-align flex-nowrap padding-4">
                    <i class="fa-lg fas fa-file-signature" style="padding-right: 5px"></i>
                    Senior Trip Contract
                </div>
                <div class="col-xs-6 vertical-align flex-nowrap padding-4">
                    <i class="fa-lg fas fa-bed" style="padding-right: 5px"></i>
                    Roommate Assignments
                </div>
            </div>
            <div class="clear" style="height: 15px"></div>
        </div>
    </form>
</div>

<div id="sponsor" data-=''>
    <h2>
        <i class="fas fa-"></i> Add Admins
    </h2>
    <div>
        <form id='addChapForm' name='addChapForm'>
        <select id='chapType' class='form-control'>
            <option value="Admin Type" selected disabled>Admin Type</option>
            <option value='administrator'>Site Administrator</option>
            <option value='sponsor'>Class Sponsor</option>
            <option value='chaperone'>Chaperone</option>
        </select>
        <br/>
        <input id='chapName' name='chapName' type='text' placeholder="Admin Name (include middle name or initial)" class='form-control' /><br/>
        <input id='chapEmail' name='chapEmail' type='text' placeholder="Admin Email" class='form-control' /><br/>
        <input id='gradYear' name='gradYear' type='number' placeholder="Class Sponsor Year" class='form-control' /><br/>
        <div id="admins">
            <input id='chapClass' name='chapClass' type='text' placeholder="Classroom" class='form-control' /><br/>
            <input id='chapPhone' name='chapPhone' type='phone' placeholder="Phone Number" class='form-control' /><br/>
        </div>
        <div class='btn btn-primary'>Submit</div>
        </form>
    </div>
    <br/>
    <form data-table="" where-="">
    </form>
</div>
<br/><br/>
<script>
    $(document).ready(function(){
        $("#gradYear").hide();
        $("#admins").hide();
        $("#displayAssignments").change(function(){
            var gradYear = $(this).attr("data-id");
            var checked = (this.checked)? 1 : 0;
                $.ajax({
                    url: 'scripts/connection.php?updateValues.php',
                    type: 'POST',
                    data:{
                        "table": "trip",
                        "where-gradYear": gradYear,
                        "displayAssignments": checked,
                    },
                });
                if (checked == true){
                    $(this).parent().parent().next().addClass("background-blue");
                    $(this).parent().parent().next().children().addClass("color-white").removeClass("color-black");
                }
                else {
                    $(this).parent().parent().next().removeClass("background-blue");
                    $(this).parent().parent().next().children().addClass("color-black").removeClass("color-white");
                }
        });
        $("#addEvent").click(function(){
            var date=$("#newEventDate").val().split("/").join("-");
            var time=$("#newEventTime").val();
            var desc=$("#newEventDesc").val();
            $.ajax({
                url:"scripts/connection.php?insertInto.php",
                type:"POST",
                data: {
                    table: "itinerary",
                    dateTime: date+" "+time,
                    isNote: "",
                    description: desc,
                    gradYear: date.substring(0,4)
                },
                success:function(response){
                    
                },
                error:function(){
                    alert("didn't work oh well");
                }
            });
        }); 
        $("#userFunctions").on('show.bs.modal', function(){
            /* PROFILE */
            $.ajax({
                url:"scripts/connection.php?getFrom.php",
                type:"POST",
                data: {
                    table:"admin",
                    where: true,
                    adminID: $("#userFunctions #profile").attr("data-id"),
                },
                success:function(response){
                    var row=response.split("ENDOFROW");
                    var cols=row[0].split("\n");
                    var target=[
                        "fName",
                        "mName",
                        "lName",
                        "email",
                        "classroom",
                        "phone",
                    ];
                    for(var y=0; y < cols.length; y++){ //each column
                        var dict=cols[y].split(":::"); //array of length 2
                        if(target.includes(dict[0]))
                            $("#profile [name='"+dict[0]+"']").val(dict[1]);
                    }
                },
            });//end of admin getFrom ajax call
            
            /* TRIP */
            $("#trip h2 .content").text($("#trip").attr("data-gradYear"));
            $.ajax({
                url:"scripts/connection.php?getFrom.php",
                type:"POST",
                data: {
                    table:"trip",
                    where: true,
                    gradYear: $("#userFunctions #trip").attr("data-gradYear"),
                },
                success:function(response){
                    var row=response.split("ENDOFROW");
                    var cols=row[0].split("\n");
                    var target=[
                        "pay1",
                        "payDate1",
                        "pay2",
                        "payDate2",
                        "pay3",
                        "payDate3",
                        "floridaStart",
                        "floridaEnd",
                    ];
                    for(var y=0; y < cols.length; y++){ //each column
                        var dict=cols[y].split(":::"); //array of length 2
                        if(target.includes(dict[0])){
                            if($("#trip [name='"+dict[0]+"']").hasClass("datepicker")){
                                var date=dict[1].split(" ");
                                date[0]=date[0].split("-").join("/");
                                $("#trip [name='"+dict[0]+"']").val(date[0]);
                                if($("#trip [name='"+dict[0]+"-time']").length > 0){
                                    //12:00:00 -> 12, 00
                                    date[1]=date[1].substring(0, 5);
                                    var time=date[1].split(":");
                                    var meridiem=(Math.floor(time[0]/12) == 0)? "AM" : "PM";
                                    time[0]=time[0]%12;
                                    if(time[0] == 0) time[0]+=12;
                                    $("#trip [name='"+dict[0]+"-time']").val(time[0]+":"+time[1]+" "+meridiem);
                                }
                            }
                            else
                                $("#trip [name='"+dict[0]+"']").val(dict[1]);
                        }
                    }
                },
            });//end of trip getFrom ajax call
        });//end of userFunctions modal.show
        $('#chapType').change(function(){
           if($(this).val()!="chaperone"){
               if($(this).val()=="sponsor"){$("#gradYear").show();}
               else{$("#gradYear").hide();}
               $('#admins').show();
           } 
           else{
               $('#admins').hide();
               $("#gradYear").hide();
           }
        });
        $('#addChapForm .btn').click(function(){
           $type=$('#chapType').val();
           $nameOG=$('#chapName').val();
           $name=$nameOG.split(" ");
           $email=$('#chapEmail').val();
           if($type=="chaperone"){
               //send into chaperones table
               $.ajax({
                            url: "scripts/connection.php?insertInto.php",
                            type: "POST",
                            data: {
                                table: "chaperones",
                                chapID: null,
                                email:$email,
                                fName:$name[0],
                                mName:$name[1],
                                lName:$name[2]
                            },
                            success: function(response){
                                $alert="<div class='alert bg-success'>"+$nameOG+" has been added to the site as a chaperone.</div>";
                                $('#addChapForm').append($alert);
                                window.setTimeout(function(){$('#addChapForm .alert').remove();},10000);
                            },
                        });
           }
           else{
               $class=$('#chapClass').val();
               $phone=$('#chapPhone').val();
               $year=9999;
               if($type=="sponsor"){
                   $year=$('#gradYear').val();
               }
               $.ajax({
                            url: "scripts/connection.php?insertInto.php",
                            type: "POST",
                            data: {
                                table: "admin",
                                adminID: null,
                                email:$email,
                                classroom:$class,
                                phone:$phone,
                                fName:$name[0],
                                mName:$name[1],
                                lName:$name[2],
                                gradYear:$year
                            },
                            success: function(response){
                                $alert="<div class='alert bg-success'>"+$nameOG+" has been added to the site as a "+$type+".</div>";
                                $('#addChapForm').append($alert);
                                window.setTimeout(function(){$('#addChapForm .alert').remove();},10000);
                            },
                        });
           }
        });
    });
</script>