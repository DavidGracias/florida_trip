<?php
    include("connection.php");
    $to=$_POST["to"]; $subject=$_POST["subject"]; $message=$_POST["msg"];
    $headers='MIME-Version: 1.0' . "\r\n";
    $headers .='Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .="From: pwseniortrip@colonialsd.org";
    $text;
    $emailResult = mysqli_query($conn,"SELECT * from students where studID=".$_POST["id"]);
    $emailArr = mysqli_fetch_assoc($emailResult);
    $to=$emailArr["email"];
    
    
    ///reminder code
    if($_POST["reciepts"] == true){
        $subject="Urgent Senior Trip Reminder";
        $reminder= $_POST["subject"]; //replace this with the post/get of what the message is for
        switch($reminder){
            case "form":
                $text="You still need to complete your medical information form for the Senior Trip.";
                break;
            case "payment":
                $text="You still need to pay your next payment for the Senior Trip.";
                break;
        }
        $subject="Urgent Senior Trip Reminder";
        $message=<<<HEREDOC
<html>
    <head>
        <title>{$subject}</title>
    </head>
    <body style='margin: 20px'>
        <p>Reminder: {$text}</p>
        <p>Please log on to www.colonialsd.org/REPLACETHISWITHCORRECTLINK to complete this action, you must complete this as soon as possible </p>
        <p>If you have any questions, please contact Mr. Gregg or your class sponsor.</p>
        <p>DO NOT REPLY TO THIS EMAIL</p>
        
    </body>
</html>
HEREDOC;
    }
    else{//receipts code
        $subject = "Florida Payment Reciept";
        $amount = $_POST["amount"];
        $transType = $_POST["type"];
        echo transType;
        $message = "bruh";
    }
    
    if($to !=null && $subject !=null && $message !=null){
        echo mail($to, $subject, $message, $headers);
    }
    else echo -1;
    
?>