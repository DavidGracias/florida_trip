<?php
    $result = mysqli_query($conn, "SELECT * FROM `assignments` WHERE `id`={$_POST['id']}");
    if(mysqli_num_rows($result) == 0)
        exit;
    $row = mysqli_fetch_assoc($result);
    $studs = array($row["stud1"], $row["stud2"], $row["stud3"], $row["stud4"]);
    $names = array();
    for ($i = 0; $i < count($studs); $i++){
        if ($studs[$i] == ""){
            $names[$i] = "";
        }
        else {
            $result = mysqli_query($conn, "SELECT * FROM `students` WHERE `studID`='{$studs[$i]}'");
            if(mysqli_num_rows($result) == 0)
                $names[$i] = "";
            else{
                $row = mysqli_fetch_assoc($result);
                $names[$i] = $row["fName"]." ".$row["lName"];
            }
        }
    }
    echo join(",",$names).(",").join(",",$studs);
    
?>