<?php
$result = mysqli_query($conn, "SELECT * FROM `trip` WHERE `gradYear`='".$_SESSION["gradYear"]."'");
$authorizedStudent = false;
if($_SESSION["userLevel"] == $_userType["student"] && mysqli_num_rows($result) > 0 && $row = mysqli_fetch_assoc($result));
    $authorizedStudent = ($row['displayAssignments'] == 1);
if($authorizedStudent){ ?>
    <div class="padding-4 color-white" id="assignments">
        <h1 style="color: #2d3774">Roommates Assignments</h1>
        <?php
        $sql="SELECT * FROM `assignments` WHERE ".$_SESSION["id"]." in(stud1, stud2, stud3, stud4)";
        $currentRoomResults=mysqli_query($conn, $sql);
        if(mysqli_num_rows($currentRoomResults) > 0 && $row=mysqli_fetch_assoc($currentRoomResults)){ ?>
            <div class="modal fade" id="confirmLeaveRoomModal" tabindex="-1" role="dialog" aria-labelledby="confirmLeaveRoomModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="padding-4 color-black bold text-center">Are you sure you want to leave this room?</h4>
                        </div>
                        <div class="modal-footer" style="clear: both">
                          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal" onclick="leaveRoom()">Confirm</button>
                          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function leaveRoom(){
                    $.ajax({
                        url: "scripts/connection.php?assignments/leaveRoom.php",
                        success: function(response){
                            window.location.reload();
                        },
                    });
                }
            </script>
            <div class="background-darkest-blue padding-4 margin-3">
                <h2>
                    Current Room <div class="btn btn-danger" style="margin-left: 15px" data-toggle="modal" data-target="#confirmLeaveRoomModal">Leave Room</div>
                </h2>
                <div class="container-fluid">
                <?php $roomID=$row["id"];
                    $students=[ $row["stud1"], $row["stud2"], $row["stud3"], $row["stud4"] ];
                    $eq=array_search($_SESSION["id"], $students);
                    
                    for($i=0; $i < count($students); $i++){ ?>
                        <div class="padding-5 col-xs-12 col-sm-6" style="height: 60px">
                            <?php
                            if( is_null($students[$i]) ){ ?>
                                <div class="vertical-align nowrap">
                                    <i class="fa-lg fas fa-bed" style="padding-right: 6px"></i>
                                    <div class="content"></div>
                                </div>
                                <div class="flex-nowrap vertical-align" style="padding-top: 3px; font-size: .75em">
                                    Only roommates who have accepted their invites will appear here!
                                </div>
                            <?php }
                            else{
                                $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`='".$students[$i]."'");
                                if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
                                    $content=$row["fName"]." ".$row["mName"]." ".$row["lName"];
                                }?>
                                <div class="vertical-align">
                                    <i class="fa-lg fas fa-bed color-green"></i>
                                    <div style="padding-left: 6px">
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
                $roommates=-1;
                for($x=0; $x < count($students); $x++)
                    if(!is_null($students[$x]) )
                        $roommates++;
                    
                if($roommates < 3){ //3 roommates to form a 4-person room ?>
                <div class="background-darkest-blue padding-4 margin-3">
                    <h2>
                        Roommate Invite System
                    </h2>
                    <div class="container-fluid">
                        <div style="font-size: .8em; margin: -10px 0 10px 0">
                            All members of a room must invite the same person in order for that person to be able to join!
                        </div>
                    <?php
                        $sql="SELECT * FROM `roomInvites` WHERE `roomID`='$roomID' ORDER BY CASE WHEN `inviterID`='".$_SESSION["id"]."' THEN 0 ELSE 1 END, inviterID";
                        $invites=mysqli_query($conn, $sql);
                        //case when animal_name like 'cat%' then 0 else 1 end, animal_name
                        $inviteeIDs=array();
                        while($inviteRow=mysqli_fetch_assoc($invites)){
                            if(in_array($inviteRow["inviteeID"], $inviteeIDs))
                                continue;
                            else array_push($inviteeIDs, $inviteRow["inviteeID"]);
                            
                            $invitee=$inviteRow["inviteeID"];
                            $student=mysqli_query($conn,"SELECT * FROM `students` WHERE `studID`='$invitee'");
                            if(mysqli_num_rows($student) > 0 && $studRow=mysqli_fetch_assoc($student))
                                $invitee=$studRow["fName"]." ".$studRow["mName"]." ".$studRow["lName"]." ";
                            else continue;
                        ?>
                            <div style="padding: 5px 0px">
                                <div class="vertical-align nowrap">
                                    <i class="fa-lg fas fa-bed color-<?php echo ($inviteRow["inviterID"] !=$_SESSION["id"])? 'red' : 'orange'; ?>" style="padding-right: 6px"></i>
                                    <div class="content"><?php echo $invitee; ?></div>
                                </div>
                                <div class="flex-nowrap vertical-align" style="padding-top: 4px">
                                    <?php if($inviteRow["inviterID"] !=$_SESSION["id"]){ ?>
                                        <div class="btn background-green color-white padding-1 margin-1" data-type="send-invite" data-id="<?php echo $inviteRow["inviteeID"]; ?>">
                                            Invite!
                                        </div>
                                        <div class="btn background-red color-white padding-1 margin-1" onclick="$(this).parent().parent().remove();">
                                            Ignore
                                        </div>
                                    <?php }
                                    else{ $roommates++; ?>
                                        <div class="btn background-red color-white padding-1 margin-1" data-type="cancel-invite" data-id="<?php echo $inviteRow["id"]; ?>">
                                            Cancel Invite
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php }
                        
                        while($roommates++ < 3){ ?>
                            <div style="padding: 5px 0px">
                                <div class="vertical-align flex-nowrap">
                                    <i class="fa-lg fas fa-bed" style="padding-right: 6px"></i>
                                    <div class="content">Search Below</div>
                                </div>
                                <div class="flex-nowrap vertical-align" style="padding-top: 1px">
                                    <input style="height: auto; padding: 2px 4px" type='text' class='form-control searchRoommate fa-sm color-black' placeholder='Roommate Name...'/>
                                    <i class='fas fa-paper-plane padding-2 pointer hover-blue' title='Send Request' id="<?php echo $roomID; ?>"></i>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php }
            ?>
            <script>
                var availableTags=[];
                $( function(){
                    availableTags=[ <?php
                        $notGender="-1";
                        $result=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`='".$_SESSION["id"]."' AND NOT `gender`=2");
                        if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
                            $notGender=abs( intval($row["gender"])-1 );
                        }
                        $where="WHERE `gradYear`=".$_SESSION["gradYear"]." AND NOT `studID`='".$_SESSION["id"]."' AND NOT `gender`='$notGender'";
                        $result=mysqli_query($conn, "SELECT * FROM `students` ".$where);
                        while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                            {
                                value: "<?php echo $row["studID"]; ?>",
                                label: "<?php echo ucwords($row["fName"]." ".$row["mName"]." ".$row["lName"]); ?>",
                                desc: "(<?php echo $row["studID"]; ?>)",
                            },
                        <?php } ?>
                    ];
                    $("#assignments .searchRoommate").autocomplete({
                        minLength: 1,
                        source: availableTags,
                        focus: function( event, ui ) {
                            $(this).parent().prev().find(".content").text( ui.item.label )
                            $(this).val( ui.item.value );
                        return false;
                      },
                    }).autocomplete( "instance" )._renderItem=function( ul, item ) {
                          return $( "<li>" )
                            .append( "<div>" + item.label + "<br>" + item.desc + "</div>" )
                            .appendTo( ul );
                    };
                });
                
                $(document).ready(function(){
                    $("#assignments input").keyup(function(){
                        var elem=$(this).parent().prev().find(".content");
                        for(var i=0; i < availableTags.length; i++){
                            var obj=availableTags[i];
                            if( obj.value == $(this).val() ){
                                elem.text(obj.label)
                                return;
                            }
                        }
                        elem.text("Search Below");
                    });
                    $(".fa-paper-plane").click(function(){
                        if($(this).parent().prev().find(".content").text() !="Search Below")
                            $.ajax({
                                url: "scripts/connection.php?assignments/invite.php",
                                type:"POST",
                                data:{
                                    invitee: $(this).siblings().first().val(),
                                },
                                success:function(data){
                                    alert(data);
                                    window.location.reload();
                                }
                            });
                        else
                            $(this).prev().dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                    });
                    $('[data-type="cancel-invite"]').click(function(){
                        $.ajax({
                            url: "scripts/connection.php?assignments/invite.php",
                            type:"POST",
                            data:{
                                id: $(this).attr("data-id"),
                                cancel: true,
                            },
                            success:function(data){
                                window.location.reload();
                            }
                        });
                    });
                    $('[data-type="send-invite"]').click(function(){
                        $.ajax({
                            url: "scripts/connection.php?assignments/invite.php",
                            type: "POST",
                            data: {
                                invitee: $(this).attr("data-id"),
                            },
                            success:function(data){
                                alert(data);
                                window.location.reload();
                            }
                        });
                    });
                });
            </script>
        <?php }
        
        $results=mysqli_query($conn, "SELECT DISTINCT `roomID` FROM `roomInvites` WHERE `inviteeID`='{$_SESSION['id']}' ORDER BY `roomID`");
        $curRoom=-1;//stores current room ID
         //student has invites
        if(mysqli_num_rows($results) > 0){ ?>
        <div class="background-darkest-blue padding-4 margin-3">
            <h2> Room Requests </h2>
            <div class="padding-4">
            <?php
                $nav='<ul class="nav nav-pills">';
                $content='<div class="tab-content">';
                $i=1;
                while(mysqli_num_rows($results) > 0 && $row=mysqli_fetch_assoc($results)){
                    $nav.="<li style='margin-right: 10px' " .( ($i==1)? "class='active'" : "" )."><a data-toggle='pill' href='#roomInvite$i'>Room $i</a></li>";
                    $content.="<div id='roomInvite$i' class='tab-pane fade ".( ($i==1)? "in active" : "" )."'>";
                    $body="";
                    
                    $inviterID=array();
                    $countResult=mysqli_query($conn, "SELECT * FROM `roomInvites` WHERE `roomID`=".$row['roomID']." AND `inviteeID`='{$_SESSION['id']}'");
                    while(mysqli_num_rows($countResult) > 0 && $countRow=mysqli_fetch_assoc($countResult))
                        array_push($inviterID, $countRow["inviterID"]);
                    
                    $roomResult=mysqli_query($conn, "SELECT * FROM `assignments` WHERE `id`=".$row['roomID']." LIMIT 1");
                    $room=mysqli_fetch_assoc($roomResult);
                    $roommates=0;
                    $body.="<div>Invited to a room with: </div>";
                    $body.="<div style='margin-left: 1em'>  ";
                    for($x=1; $x<=4; $x++){
                        $stud=$room["stud$x"];
                        if(!is_null($stud)){
                            $roommates++;
                            $name=mysqli_query($conn, "SELECT `fName`, `lName` FROM `students` WHERE `studID`=$stud");
                            $name=mysqli_fetch_assoc($name);
                            if(in_array($stud, $inviterID)){
                                $body.="<span class='color-green'><i class='fas fa-user padding-1'></i>";
                                $body.=$name['fName']." ".$name['lName'];
                                $body.="</span>, ";
                            }
                            else{
                                $body.="<span class='color-red'><i class='far fa-user padding-1'></i>";
                                $body.=$name['fName']." ".$name['lName'];
                                $body.="</span>, ";
                            }
                            
                        }
                    }
                    // $body.="</div>";
                    $body=substr($body, 0, strlen($body)-strlen(", "))."</div>";
                    $content.="<h3 class='vertical-align'><span style='margin-right:20px'>Room #$i</span>";
                        if($roommates==count($inviterID)){
                            $content.="<div class='btn btn-success padding-2 ";
                            if(mysqli_num_rows($currentRoomResults) > 0)
                                $content.="disabled' data-toggle='popover' data-placement='top' data-trigger='hover' data-content='You must leave your current room before you can join this one!' ";
                            else
                                $content.="' data-type='accept' data-id='".$row['roomID']."'";
                            $content.= ">Accept</div>";
                        }
                        else
                            $content.="(".count($inviterID)." of $roommates invites received)";
    //DENY BUTTON --> DOESNT CURRENTLY WORK YET
                        $content.="<div style='margin-left:10px' class='btn btn-danger padding-2'  data-type='deny' data-id='".$row['roomID']."'>Deny</div>";
                    
                    $content.="</h3>";
                    $content.="$body</div>";
                    $curRoom=$row["roomID"];
                    $i++;
                }
                if(mysqli_num_rows($results) > 1)
                    echo $nav."</ul>";
                echo $content."</div>";
            ?>
            </div>
            <script>
                $(document).ready(function(){
                <?php if(mysqli_num_rows($currentRoomResults) == 0){ ?>
                    $('#assignments [data-type="accept"]').click(function(){
                        $.ajax({
                            url: "scripts/connection.php?assignments/acceptRoom.php",
                            type: "POST",
                            data:{
                                id: $(this).attr('data-id'),
                            },
                            success: function(response){
                                alert(response)
                                window.location.reload();
                            },
                        });//end of ajax
                    });
                <?php }
                else{ ?>
                    $('#assignments [data-toggle="popover"]').popover();
                <?php } ?>
                    $('#assignments [data-type="deny"]').click(function(){
                        $.ajax({
                            url: "scripts/connection.php?assignments/denyRoom.php",
                            type: "POST",
                            data:{
                                id: $(this).attr('data-id'),
                            },
                            success: function(response){
                                // document.write(response)
                                window.location.reload();
                            },
                        });//end of ajax
                    });
                });
            </script>
        </div>
        <?php }
        $currentRoomResults=mysqli_query($conn, "SELECT * FROM `assignments` WHERE ".$_SESSION["id"]." in(stud1, stud2, stud3, stud4)");
        if(mysqli_num_rows($currentRoomResults) == 0){ //student isn't in a room ?>
        <div class="background-darkest-blue padding-4 margin-3">
            <?php if(mysqli_num_rows($results) > 0){ ?>
                    <div class="padding-4 text-center">
                        <br/>
                        You may join one of the rooms above once all members of the room have invited you
                        <br/>
                        Alternatively, you can create a room now and invite your friends!
                        <br/>
                    </div>
                <?php }
                else{ ?>
                    <div class="padding-4 text-center">
                        <br/>
                        You are not currently in any room for the senior trip.
                        <br/>
                        Create one now OR tell your friends to invite you to their room!
                        <br/>
                    </div>
                <?php } ?>
                <div class="text-center" style="margin-top: 10px">
                    <div class="btn btn-primary" onclick="createRoom()">
                        Create Room
                    </div>
                </div>
                <script>
                    function createRoom(){
                        $.ajax({
                            url: "scripts/connection.php?insertInto.php",
                            type: "POST",
                            data: {
                                table: "assignments",
                                id: null,
                                stud1: "<?php echo $_SESSION['id']; ?>",
                            },
                            success: function(response){
                                window.location.reload();
                            },
                        });
                    }
                </script>
            </div>
            <?php } ?>
    </div>
<?php }
else if($_SESSION["userLevel"] == $_userType["chaperone"]){ ?>
    <!--Chaperones can see-->
    <!--
        -Rooms assigned to them
        -Students in those rooms
    -->
    <div class="background-darkest-blue padding-4 margin-3" style='color:white'>
        <div>
            <h2>Room Assignments</h2>
            <p>Names are</p>
            <?php
                $chaperoneID=0;
                $result=mysqli_query($conn, "SELECT * from chaperones where `email`='".$_SESSION["email"]."'"); //set to my person email for now
                if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)) {
                    $chaperoneID=$row["chapID"];
                }
            ?>
    </div>
        <div>
            <table class="table table-striped">
                <th>
                    <td>Group Number</td>
                    <td>First Name</td>
                    <td>Middle Name</td>
                    <td>Last Name</td>
                    <td>Plane Down</td>
                    <td>Plane Back</td>
                    <td>Bus</td>
                    <td>Room Number</td>
                </th>
            <?php
                //started some bs but please scrap this prob repeats what hannah wrote
                /*$i=1;
                $result=mysqli_query($conn, "SELECT * from assignments where `id`='".$chaperoneID."'");
                while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result) && $i<3) { //"$i<3 is wrong bbut causes an infinite loop without"
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    $rowthing=$row["stud".$i];
                    $result=mysqli_query($conn, "SELECT * from students where `studID`='".$rowthing."'"); 
                    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)) {
                        echo "<td>".$row["studID"]."</td>";
                        echo "<td>".$row["fName"]."</td>";
                        echo "<td>".$row["mName"]."</td>";
                        echo "<td>".$row["lName"]."</td>";
                    }
                    $result=mysqli_query($conn, "SELECT * from assignments where `id`='".$chaperoneID."'");
                    echo "<td>".$row["planeDown"]."</td>";
                    echo "<td>".$row["planeBack"]."</td>";
                    echo "<td>".$row["bus"]."</td>";
                    echo "<td>".$row["roomNum"]."</td>";
                    echo "</tr>";
                } */
            ?>
            </table>
        </div>
    </div>
<?php }
else{ ?>
    <script>
        document.location.replace('index.php');
    </script>
<?php } ?>