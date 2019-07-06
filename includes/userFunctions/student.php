
                <?php
$result=mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`=".$_SESSION["gradYear"]);
$row=mysqli_fetch_assoc($result);
$changeGender=($row["displayAssignments"] == 0);
?>
<div id="profile" data-id='<?php echo $_SESSION["id"]; ?>'>
    <h2>
        <i class="fas fa-users"></i> Profile
    </h2>
    <div class="desc">
        ANY CHANGES MADE HERE WILL CHANGE THROUGHOUT THE SITE<br/>
        SAVE TO COMMIT CHANGES TO THE DATABASE
    </div>
    <br/>
    <form data-table="students" where-studID="<?php echo $_SESSION["id"]; ?>">
        <div class="col-xs-12 col-sm-4 padding-0 input-group pull-left">
            <div class="input-group-addon background-blue color-white">
                Student ID
            </div>
            <div class="flex-grow input-group-addon background-white">
                <?php echo $_SESSION["id"]; ?>
            </div>
        </div>
        <div class="clear visible-xs visible-md" style="height: 20px"></div>
        
        <div class="col-xs-12 col-sm-6 col-sm-offset-1 col-md-offset-0 col-lg-offset-1 padding-0 input-group pull-left">
            <div class="input-group-addon background-blue color-white">
                <span class="input-group-text">
                    Graduation Year
                </span>
            </div>
            <div class="flex-grow input-group-addon background-white">
                <?php echo $_SESSION["gradYear"]; ?>
            </div>
        </div>
        <br/>
        <div class="clear" style="height: 25px"></div>
        
        <div class="padding-0 input-group vertical-align flex-nowrap">
            <span class="input-group-text background-blue color-white padding-2" style="border-top-left-radius: 3px; border-bottom-left-radius: 3px;">
                Email
            </span>
            <div class="flex-grow input-group-addon background-white">
                <?php echo $_SESSION["email"]; ?>
            </div>
        </div>
        <br/>
        
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
        
        <div class="col-xs-12 padding-0 input-group vertical-align">
            <span class="input-group-text background-blue color-white padding-2" style="margin-right: 10px; border-top-left-radius: 3px; border-bottom-left-radius: 3px;">
                Gender
            </span>
            <div class="flex-grow input-select" name="gender">
                <div class="select blue" data-value="0">
                    Male
                </div>
                <div class="select pink" data-value="1">
                    Female
                </div>
                <div class="select yellow" data-value="2">
                    Other
                </div>
            </div>
        </div>
        <br/>
        <span class="help-block text-center">
                You may connect your parent's / guardian's email addresses to your account.
        </span>
        <div class="input-group col-xs-12">
            <span class="input-group-addon background-blue color-white">
                Parent Email(s)
            </span>
            <input type="email" class="form-control" name="addEmail-student" placeholder="parent@gmail.com">
            <span id="addEmailStudent" class="btn btn-primary input-group-addon pointer color-white"><i class="fas fa-plus-square padding-1"></i> Add</span>
        </div>
        <div class="padding-4"><?php
            $result = mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`='{$_SESSION['id']}'");
            if(mysqli_num_rows($result) > 0 && $row = mysqli_fetch_assoc($result)){
                $emails = explode(":::", $row["altEmail"]);
                for($i=0; $i < count($emails); $i++){ ?>
                    <div class='display-inline'>
                        <span class='pointer addedEmail border-bottom border-bottom-red'><?php
                            echo $emails[$i];
                            if($i != count($emails)-1)
                                echo ",";
                            ?></span>
                    </div>
                <?php }
            }
        ?></div>
        <div class="col-xs-12">
            <br/><br/>
            <button id = "submitStudentChanges" data-id = "<?php echo $_SESSION["id"]; ?>" value="submit" class="btn background-green color-white pull-right">Save</button>
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
        $("#addEmailStudent").click(function(){
            var email=$("#addEmailStudent").prev();
                if(email.val().indexOf("@") == -1 || email.val().indexOf("colonialsd") > -1){
                    alert("You must enter a non-CSD email.");
                    return;
                }
                var content=$(this).parent().next();
                var add="<div class='display-inline'>";
                add += " <span class='pointer addedEmail border-bottom border-bottom-red'> "+email.val()+"</span>, ";
                add += "</div>";
                content.prepend(add);
                email.val("");
                email.focus();
        }); 
        $(document).on("click", "#userFunctions .addedEmail", function(){
                $(this).remove();
        });
        $(document).on("click","#submitStudentChanges",function(){
            //alert("help");
            var emails = [];
            $(".addedEmail").each(function(){
                var text = $(this).text().replace(/[\s\,]/g, "");
                if(text.length == 0)
                    return;
                emails.push(text);
                //$(this).remove();
            });
            var eString = emails.join(":::");
            //alert(eString)
            $.ajax({
                url: "scripts/connection.php?updateValues.php",
                type:"POST",
                data:{
                    "table":"students",
                    "where-studID": $(this).attr("data-id"),
                    "altEmail":eString,
                },
                success:function(result){
                    
                },
                error:function(){
                    alert("could not connect to database");
                }
            })
        });
        <?php if($changeGender && false){ ?>
            $("#profile .select").click(function(){
                if(!$(this).hasClass("active"))
                    $(this).addClass("active");
                $(this).siblings().removeClass("active");
            });
        <?php } ?>
        $("#userFunctions").on('show.bs.modal', function(){
            $("#userFunctions #profile [name='gender']").children().addClass("no-pointer").removeClass("btn active gender");
            /* PROFILE */
            $.ajax({
                url:"scripts/connection.php?getFrom.php",
                type:"POST",
                data: {
                    table:"students",
                    where: true,
                    studID: $("#userFunctions #profile").attr("data-id"),
                },
                success:function(response){
                    var row=response.split("ENDOFROW");
                    var cols=row[0].split("\n");
                    var target=[
                        "fName",
                        "mName",
                        "lName",
                        // "gender",
                        "altEmail",
                    ];
                    for(var y=0; y < cols.length; y++){ //each column
                        var dict=cols[y].split(":::"); //array of length 2
                        if(dict[0] == "gender"){
                            $("#userFunctions #profile [name='gender']").children().eq(parseInt(dict[1], 10))
                            .addClass("btn active gender")
                            .removeClass("no-pointer");
                        }
                        if(target.includes(dict[0]))
                            $("#profile [name='"+dict[0]+"']").val(dict[1]);
                    }
                },
            });
        });//end of userFunctions modal.show
    });
</script>