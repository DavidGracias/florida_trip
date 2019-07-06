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
                    table: "admin",
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