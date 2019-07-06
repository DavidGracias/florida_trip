<?php
    $valid=isset($_POST["table"]);
    $result=mysqli_query($conn, "DESCRIBE `". $_POST["table"] ."`");
    while($valid && mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
        if( $row["Null"] == "NO" && !array_key_exists($row["Field"], $_POST) && $row["Extra"] !="auto_increment" ){
            if( strpos(strtolower($row["Field"]), "id") !==false ){
                $_POST[ $row["Field"] ]=$_SESSION["id"];
            }
            else if(array_key_exists($row["Field"], $_SESSION)){
                $_POST[ $row["Field"] ]=$_SESSION[ $row["Field"] ];
            }
            else if(strlen($row["Default"]) > 0){
                $_POST[ $row["Field"] ]=$row["Default"];
            }
            else{
                $valid=false;
                break;
            }
        }
    }
    if(!$valid) exit;
    //verify that the data submitted will be valid
    
    
    $cols="";
    $values="";
    foreach ($_POST as $key=> $value){
        if($key == "table")
            continue;
        $cols.="`$key`,";
        $values.="'$value',";
    }
    $sql="INSERT INTO `" .$_POST["table"]. "` (".substr($cols, 0, -1).") VALUES (".substr($values, 0, -1).")";
    echo $sql;
    if(strlen($cols) > 0 && strlen($values) > 0 && mysqli_query($conn, $sql)){
        $result=mysqli_query($conn, "SHOW KEYS FROM `" .$_POST["table"]. "` WHERE Key_name='PRIMARY'");
        $primary=mysqli_fetch_assoc($result)["Column_name"];
        $where="";
        foreach ($_POST as $key=> $value){
            if($key == "table")
                continue;
            $where.="`$key`='$value' AND ";
        }
        $sql="SELECT * FROM `" .$_POST["table"]. "` WHERE ".substr($where, 0, -strlen(" AND "))." LIMIT 1";
        echo $sql;
        $result=mysqli_query($conn, $sql);
        $value=mysqli_fetch_assoc($result)[$primary];
        
        echo $primary.":::".$value;
    }
    else if(strlen($cols) == 0 || strlen($values) == 0)
        echo "SQL code formatted incorrectly";
    else echo mysqli_error ( $conn );
    
?>