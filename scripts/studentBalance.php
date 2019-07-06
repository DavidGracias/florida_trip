<?php
    $id = $_POST['studID'];
    $transactions = array();
    
    $result = mysqli_query($conn, "SELECT * FROM `transactions` WHERE `studID`='".$id."'");
    while(mysqli_num_rows($result)>0 && $row=mysqli_fetch_assoc($result)){
        array_push($transactions,implode(":::",$row));
    }
    echo implode("\n",$transactions);
?>