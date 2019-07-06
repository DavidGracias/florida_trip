<?php
    $fields=array();
    $result=mysqli_query($conn, "DESCRIBE `". $_POST["table"] ."`");
    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result))
        array_push($fields, $row["Field"]);
print_r($fields);
    $set="";
    $where=""; //only one "where"
    foreach ($_POST as $key=> $value){
        if($key == "table")
            continue;
        else if(strpos($key."", "where-") !==false)
            $where="`".substr($key, strpos($key."", "where-")+strlen("where-"))."`='".$_POST[$key]."'";
        else if( in_array($key, $fields) )
            $set.=<<<HEREDOC
`$key`="$value",
HEREDOC;
    }
    $set=substr($set, 0, -1);
    $sql=<<<HEREDOC
UPDATE `{$_POST["table"]}` SET $set WHERE $where
HEREDOC;
    echo $sql;
    if(strlen($set) > 0 && strlen($where) > 0)
        mysqli_query($conn, $sql);
//no one mess with my heredoc  
?>