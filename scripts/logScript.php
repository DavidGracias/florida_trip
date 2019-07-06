<?php 
    // $_POST["U3"] = "davidg0130@gmail.com";
    if( $_SESSION["userLevel"] > $_userType["unsigned"] ){
        
        $temp = $_SESSION["row"];
        // session_destroy();
        // unset($_SESSION);
        $_SESSION=array("row" => $temp);
        exit;
    }
    if(strpos($_POST["U3"], "@")===false){
        echo "Email 404";
        exit;
    }
    //echo $_POST["U3"]; //email
    $suffix=substr($_POST["U3"],  strpos($_POST["U3"], "@")+1, strlen($_POST["U3"]) );
    
    if(!is_numeric($_SESSION["row"]))
        $_SESSION["row"] = 1;

    //login for existing students
    $sql=array(
        "SELECT * FROM `students` WHERE `email`='{$_POST['U3']}'",
        "SELECT * FROM `students` WHERE INSTR(`altEmail`, '{$_POST['U3']}') > 0", // LIMIT {$_SESSION['row']}, 1",
        "SELECT * FROM `chaperones` WHERE `email`='{$_POST['U3']}'",
        "SELECT * FROM `admin` INNER JOIN `trip` ON admin.gradYear = trip.gradYear WHERE `email`='{$_POST['U3']}'",
    );
        
    for($i=0; $i < count($sql); $i++){
        $result=mysqli_query($conn, $sql[$i]);
        if(mysqli_num_rows($result) > 0){
            for($r = 1; $r <= ( ($_SESSION["row"]-1) % mysqli_num_rows($result) ) +1; $r++)
                $row=mysqli_fetch_assoc($result);
            break;
        }
    }
    echo ( ($_SESSION["row"]-1) % mysqli_num_rows($result) ) +1;
    if($i == count($sql)){ //new user
        //ig="family name"
        $_SESSION["userLevel"]=$_userType["new"];
        $_SESSION["fName"]=ucfirst(strtolower($_POST["ofa"]));
        $_SESSION["mName"]="";
        $_SESSION["lName"]=ucfirst(strtolower($_POST["wea"]));
        $_SESSION["email"]=strtolower($_POST["U3"]);
    }
    else{ //existing user
        $_SESSION["userLevel"]=(intval($row["gradYear"]) == 9999)? $_userType["admin"]:$i; //admin noted by a 9999 graduation year
        if($_SESSION["userLevel"] == $_userType["sponsor"] && $row["gradYear"] == substr(nextTripYear($conn, true), 0, 4)) //sponsors are 2
            $_SESSION["userLevel"]=$_userType["admin"];
        switch($i){
        /* 4 */ case $_userType["admin"]:
        /* 3 */ case $_userType["sponsor"]: $user="admin"; break;
        /* 2 */ case $_userType["chaperone"]: $user="chap"; break;
        /* 1 */ case $_userType["parent"]: $_SESSION["altEmail"] = $_POST["U3"];
        /* 0 */ case $_userType["student"]: $user="stud"; break;
        }
        $_SESSION["id"]=$row[$user."ID"];
        $keys=array("fName", "mName", "lName", "email", "gradYear", "classroom");
        foreach ($row as $key=> $value){
            if(in_array($key, $keys))
                $_SESSION[$key]=$value;
        }
        if($_SESSION["userLevel"] == $_userType["admin"])
            $_SESSION["gradYear"] = substr(nextTripYear($conn, true), 0, 4);
    }
?>