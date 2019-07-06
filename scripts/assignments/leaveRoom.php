<?php
    $result=mysqli_query($conn, "SELECT * FROM `assignments` WHERE '".$_SESSION['id']."' in(stud1, stud2, stud3, stud4)");
    if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
        $count = 0;
        for($z=1; $z <=4; $z++){
            
            if($row["stud$z"] == $_SESSION['id']){
                //remove student from current room
                mysqli_query($conn, "UPDATE `assignments` SET `stud$z`=NULL WHERE `id`='".$row['id']."'");
                
                //remove student invites
                mysqli_query($conn, "DELETE FROM `roomInvites` WHERE `inviterID`='".$_SESSION['id']."'"); //delete empty room
            }
            else if(!is_null($row["stud$z"])) //finds number of other students in room
                $count++;
        }
        if($count == 0)
            mysqli_query($conn, "DELETE FROM `assignments` WHERE `id`='".$row['id']."'"); //delete empty room
    }
?>