<?php
    $sql = "SELECT * FROM `students` WHERE `studID`='{$_POST['studID']}'";
    // $fName = ucwords(strtolower($_POST['fName']));
    // $sql.= " AND `fName` = '{$fName}'";
    // $lName = ucwords(strtolower($_POST['lName']));
    // $sql.= " AND `lName` = '{$lName}'";
    $sql.= " AND `gender` = '{$_POST['gender']}'";
    $sql.= " AND `gradYear` = '{$_POST['gradYear']}'";
    $email = strtolower($_POST['email']);
    $sql.= " AND `email` = '{$email}'";
    $result = mysqli_query($conn, $sql);
    
    echo mysqli_num_rows($result);
    if(mysqli_num_rows($result) > 0 && $row = mysqli_fetch_assoc($result)){
        $newAltEmail = ($row["altEmail"] == NULL)? "" : $row["altEmail"].$_DELIMITER;
        $newAltEmail.= $_SESSION['email'];
        if(stripos( strtolower($row["altEmail"]), strtolower($_SESSION['email']) ) === false)
            mysqli_query($conn, "UPDATE `students` SET `altEmail`='{$newAltEmail}' WHERE `studID`='{$_POST['studID']}' ");
    }
    
    
?>