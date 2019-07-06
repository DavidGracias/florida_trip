<?php
    if(session_id()==="")
        session_start();
    //keys: userLevel, id, fName, mName, lName, email, gradYear
    
    //MySQLi Object-Oriented
    $conn=new mysqli("localhost", "root", "", "florida_trip");
    if(mysqli_connect_errno()){echo mysqli_connect_error; exit;}

    //DateTime Declaration
    date_default_timezone_set('America/New_York');
    
    $_userType=array("unsigned"=> -2, "new"=> -1, "student"=> 0, "parent" => 1, "chaperone"=> 2, "sponsor"=> 3, "admin"=> 4);
    //Set the current page
    $_PAGES=array("home"=> $_userType["unsigned"], "assignments"=> $_userType["student"], "calendar"=> $_userType["unsigned"], "finances"=> $_userType["unsigned"], "students"=> $_userType["chaperone"], "information"=> $_userType["unsigned"]);
    //userLevel: unsigned=> -2; new=> -1; student=> 0; chaperone=> 1; sponsor=> 2; admin=> 3;
    
    $_DELIMITER=":::";
    
    if(!isset($_PAGE) && key($_GET) !==null)
        include_once( replaceLastUnderScore(key($_GET)) );
        
    include_once("scripts/defaultContent.php");
    
    function alert($string){
        echo "<script> alert('$string'); </script>";
    }
    
    function nextTripYear($conn, $trueNext){
        $i=0;
        //parallel
        $tripStart=[];
        $tripEnd=[];
        $result=mysqli_query($conn, "SELECT * FROM `trip` WHERE NOT `gradYear`=9999 ORDER BY `gradYear` desc");
        while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
            array_push($tripStart, substr($row["floridaStart"], 0, 10) ); //YYYY-MM-DD
            array_push($tripEnd, substr($row["floridaEnd"], 0, 10) ); //YYYY-MM-DD
        }
        $tripDate="9999/99/99"; //this is a default value -- like a max
        for($i=0; $i < count($tripStart); $i++){
            if(!$trueNext && isset($_SESSION["gradYear"]) && $_SESSION["gradYear"] !="9999" && strpos($tripStart[$i], $_SESSION["gradYear"]."") !==false){
                $tripDate=$tripStart[$i];
                break;
            }
            else if($tripEnd[$i] > date("Y/m/d") && $tripEnd[$i] < $tripDate)
                $tripDate=$tripStart[$i];
        }
        return $tripDate;
    }
    
    function replaceLastUnderScore($url){
        $first=substr($url, 0, strrpos($url, "?")+1);
        $last=substr($url, strrpos($url, "?"));
        
        $words=array();
        for($i=0; $i < strlen($last); $i++)
            if( !preg_match("/[A-Z]|[a-z]|[0-9]|[_]|[.]/", $last{$i}) ){
                array_push($words, substr($last, 0, $i) );
                $last=substr($last, $i);
                $i=0;
            }
        
        array_push($words, $last);
        for($x=0; $x < count($words); $x++){
            $word=$words[$x];
            if(strlen($word) == 2 && substr_count($word, "_") == 2)
                $first.="..";
            else if(stripos($word, "_") !==false && $x== count($words)-1)
                $first.=substr($word, 0, strrpos($word, "_")).".".substr($word, strrpos($word, "_")+1);
            else $first.=$word;
        }
        return substr($first, 1);
    }
    
?>