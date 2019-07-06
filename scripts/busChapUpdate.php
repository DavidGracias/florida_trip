<?php
$studs=json_decode($_POST['studs'],true);//now this is an array
$bus=$_POST['bus'];
$chap=$_POST['chap'];
//will echo back a name with or without a $ sign. the $ signifies success.
for($x=0;$x<count($studs);$x++){
    $stud=$studs[$x];
    //check to see if student has room
    $hasRoom=mysqli_query($conn,"SELECT * FROM assignments WHERE $stud IN (stud1,stud2,stud3,stud4)");
    if($hasRoom&&mysqli_num_rows($hasRoom)>0){//student has room, update bus+chap
    $room="UPDATE assignments SET bus=$bus,chapID=$chap WHERE $stud IN (stud1,stud2,stud3,stud4)";
    mysqli_query($conn,$room);
    //add all roomies to output
    $hasRoom=mysqli_fetch_assoc($hasRoom);
    for($y=1;$y<=4;$y++){
        $roomie=$hasRoom["stud$y"];
        if(!is_null($roomie)){
            echo "$";
            $name=mysqli_query($conn,"SELECT fName,mName,lName from students where studID=$roomie");
            $name=mysqli_fetch_assoc($name);
            echo $name['fName']." ".$name['mName']." ".$name['lName'].",";
            echo $roomie.",";
        }
    }
    }
    else{
        $name=mysqli_query($conn,"SELECT fName,mName,lName from students where studID=$stud");
        $name=mysqli_fetch_assoc($name);
        echo $name['fName']." ".$name['mName']." ".$name['lName'].",";
        echo $stud.",";
    }
}
?>