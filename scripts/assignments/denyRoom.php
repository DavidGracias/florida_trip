<?php
    mysqli_query($conn, "DELETE FROM `roomInvites` WHERE `roomID`='".$_POST["id"]."' AND `inviteeID`='".$_SESSION['id']."'");
?>