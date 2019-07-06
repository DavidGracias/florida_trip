<?php
    if(isset($_POST["cancel"]) && isset($_POST["id"])){
        mysqli_query($conn, "DELETE FROM `roomInvites` WHERE `id`='".$_POST["id"]."'");
        exit;
    }

    $inviteeID=$_POST['invitee'];
    $inviterID=$_SESSION['id'];
    $inviteeResult=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`='$inviteeID'");
    $inviterResult=mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`='$inviterID'");

    // $inRoom=mysqli_query($conn, "SELECT * FROM `assignments` WHERE '$inviteeID' in(stud1, stud2, stud3, stud4)");
    $room=mysqli_query($conn, "SELECT * FROM `assignments` WHERE '$inviterID' in(stud1, stud2, stud3, stud4)");
    
    $rCount=0;
    $room=mysqli_fetch_assoc($room);
    for($x=1; $x <=4; $x++){
        if(!is_null($room["stud$x"]) ) $rCount++;
    }
    $invites=mysqli_query($conn, "SELECT * FROM `roomInvites` WHERE `inviterID`='$inviterID'");
    if(4-$rCount== mysqli_num_rows($invites)){
        echo "You can only send as many invites as there are vacancies in your room.";
    }
    else if( //student invited exists and isn't in room
        mysqli_num_rows($inviteeResult) == 1
        // && mysqli_num_rows($inRoom) == 0
    ){
        $inviteeRow=mysqli_fetch_assoc($inviteeResult);
        $inviterRow=mysqli_fetch_assoc($inviteeResult);
        if( $inviterRow['gender'] == 2 || $inviterRow['gender'] !=abs( intval($inviteeRow["gender"])-1) ){
            //makes sure roommates are of the appropriate gender
            
            $result=mysqli_query($conn, "SELECT * FROM `roomInvites` WHERE `inviterID`='$inviterID' AND `inviteeID`='$inviteeID'");
            //Check to see if this is the first invite
            
            if(mysqli_num_rows($result) == 0){
                mysqli_query($conn, "INSERT INTO `roomInvites` (`inviterID`, `inviteeID`, `roomID`) VALUES ($inviterID, $inviteeID, ".$room["id"].")");
                echo "You've successfully invited your friend!";
            }
            else
                echo "You've already invited this person.";
        }
        else
            echo "You can only invite students of the appropriate gender.";
        
    }
    // else if(mysqli_num_rows($inRoom) !=0)
    //     echo "This student is unavailable for roommate requests and may have already joined a room.";
    else
        echo "An error has occurred. Please try again later.";
?>