<?php
    $where="";
    if( $_POST["where"] ){
        $where="where ";
        foreach( $_POST as $key=> $value){
            if($key == "where" || $key == "table")
                continue;
            $where.="`" .$key. "`='" .$value. "' and ";
        }
        $where=substr($where, 0, -strlen(" and "));
    }
    $sql="SELECT * FROM `" .$_POST["table"]. "` " .$where;
    $result=mysqli_query($conn, $sql);
    $x=0;
    while( mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
        if($x > 0)
            echo "ENDOFROW";
        $x++;
        foreach($row as $key=> $value)
            echo $key .$_DELIMITER. $value ."\n";
    }
    
?>