<?php
    $results=mysqli_query($conn, "SELECT * FROM `assignments` WHERE `id`='".$_POST['id']."'");
    if(mysqli_num_rows($results) > 0 && $row=mysqli_fetch_assoc($results)){
        $update="";
        $nullSpots=0;
        for($y=1; $y <=4; $y++){
            if(is_null($row["stud$y"])){
                if($nullSpots == 0)
                    mysqli_query($conn, "UPDATE `assignments` SET `stud$y`='".$_SESSION['id']."' WHERE `id`='".$_POST['id']."'");
                $nullSpots++;
            }
        }
        
        
        if($nullSpots > 0){
            //removes invites from joined room
            mysqli_query($conn, "DELETE FROM `roomInvites` WHERE `roomID`='".$_POST['id']."' AND `inviteeID`='".$_SESSION['id']."'");
            
            echo "You've successfully joined your friend's room!";
            // $currRoom=mysqli_query($conn, "SELECT * FROM `assignments` WHERE '".$_SESSION['id']."' in(stud1, stud2, stud3, stud4)");
            // if(mysqli_num_rows($currRoom) > 0 && $currRoomRow=mysqli_fetch_assoc($currRoom)){
            //     for($z=1; $z <=4; $z++){
            //         if($currRoomRow["stud$z"] == $_SESSION['id']){ //remove student from current room
            //             mysqli_query($conn, "UPDATE `assignments` SET `stud$z`='' WHERE `id`='".$currRoomRow['id']."'");
            //         }
            //     }
            // }
            // mysqli_query($conn, "DELETE FROM `roomInvites` WHERE `inviteeID`='".$_SESSION['id']."';"); //delete empty room
            // mysqli_query($conn, "DELETE FROM `roomInvites` WHERE `inviteeID`='".$_SESSION['id']."'"); //removes redundant invites
        }
        else
            echo "Sorry, it looks like the room you are trying to join is full. Refresh your page and try again";
            
        if($nullSpots <=1)
            mysqli_query($conn, "DELETE FROM `roomInvites` WHERE `roomID`='".$_POST['id']."'"); //removes invites from a full room
    }
?>