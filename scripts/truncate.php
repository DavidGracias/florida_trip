<?php
    $where=""; //only one "where"
    foreach ($_POST as $key=> $value){
        if($key == "table")
            continue;
        else if(strpos($key."", "where-") !==false)
            $where="`".substr($key, strpos($key."", "where-")+strlen("where-"))."`='".$_POST[$key]."'";
    }
    $sql=<<<HEREDOC
DELETE FROM `{$_POST["table"]}` WHERE $where
HEREDOC;
    echo $sql;
    if(strlen($where) > 0)
        mysqli_query($conn, $sql);
?>