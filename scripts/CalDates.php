<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<?php
session_start();
// include("connect.php");
?>

<?php

$calID=$_POST['CalForm'];

    function splitString($String,$target){
        $num=strpos($String, $target);
        $shortened=substr($String, $num);
        
        return $shortened;
    }
    
  function CountChars($stringName,$targetchar, $start,$subtract){
        $indx=strpos($stringName, $targetchar);
        $newString=substr($stringName,$start,($indx-$subtract));
     
      return $newString;
  }  
  //Call to google calendar api through a HTTP get request, code following the call is meant to cipher through the response text and get the 
  //events from the google calendar
$xml = file_get_contents("https://www.googleapis.com/calendar/v3/calendars/".$calID."/events?key=AIzaSyC8upzCpdBj3Qjjl1rsik09J79tx8fv2Fw");
$responsebody=splitString($xml,"items");
$shorterbody=splitString($responsebody, "summary");
$split=explode("summary", $shorterbody);

$Narr=array();
$Darr=array();


for($x=1;$x<count($split);$x++){
  $Narr[($x-1)]=CountChars($split[$x],",",3,3);

    $dates=splitString($split[$x],"date");
    $datessplit=splitString($dates,":");
    
    $Darr[($x-1)]=CountChars($datessplit,"}",2,5);
    
}


$filename='../files/CalInfo.txt';
$target=fopen($filename,"w") or die("Couldn't create file.");


for($i=0;$i<count($Darr);$i++){
     fwrite($target,"".$Narr[$i].",".$Narr[$i].",".$Darr[$i]."");
     
}
fclose($target);
 echo("<script>location.href='../index.php?calendar'</script>")
?>