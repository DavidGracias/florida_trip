<?php $_PAGE="home";
    require_once("scripts/connection.php");
    $funny=false;
    
    //DONT MESS WITH THIS OR DAVID WILL FIGHT YOU
    $developer_emails=array('david.garcia@student.colonialsd.org', 'sydneyborislow@me.com','davidg0130@gmail.com', 'sydney.borislow@student.colonialsd.org', 'benjamin.lubas@student.colonialsd.org');
    if( in_array($_SESSION['email'], $developer_emails) ){
        foreach($_GET as $key => $value)
            if($value != null);
                $_SESSION[$key]=$value;
        // if(!empty($_GET))
        //     echo "<script>window.location.replace('index.php');</script>";
    }
    
    if(!isset($_SESSION["userLevel"]))
        $_SESSION["userLevel"] = $_userType["unsigned"];
    
    foreach ($_PAGES as $key => $level)
        if($_SESSION["userLevel"] >= $level && strtolower(key($_GET)) == $key)
            $_PAGE=key($_GET);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <script>
            if(window.location.href.indexOf("#") != -1) window.location.href=window.location.href.substr(0, window.location.href.indexOf("#"));
        </script>
        <title>
            PWHS - Senior Trip Website
        </title>
        
        <!-- Windows Tab Logo -->
        <link rel="icon" href="images/logo.png"/>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1, user-scalable=no"/> <!-- for phones or tablets -->
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        
        <!-- Font Awesome Library -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"/>
        
        <!-- Latest compiled and minified Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
        <!-- JQuery Library 3.3.1 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        
        <!-- GOOGLE LINKS -->
        <?php include_once("includes/google.php");?>
        
        <!-- Our Styles -->
        <link rel="stylesheet" href="styles/main.css"/>
        <link rel="stylesheet" href="styles/<?php echo $_PAGE; ?>.css"/>
        
        <!-- Our Scripts -->
        <script src="scripts/main.js"></script>
        <script src="scripts/pages/<?php echo $_PAGE; ?>.js"></script>
        <?php if($_SESSION["userLevel"] >= $_userType["sponsor"]){ ?>
            <script src='scripts/admin/admin.js'></script>
            <?php if($_SESSION["userLevel"] >= $_userType["admin"]){ ?>
                <script src='scripts/admin/<?php echo $_PAGE; ?>.js'></script>
            <?php } ?>
        <?php } ?>
    </head>
    <body class="color-black">
        <?php
            
            if($_SESSION["userLevel"] >= $_userType["student"])
                include_once("includes/userFunctions/index.php");
            include_once("includes/nav.php");
            include_once("includes/modals/itinerary.php");
            
            $result = mysqli_query($conn, "SELECT * FROM `general` WHERE `desc`='announcement'");
            if(mysqli_num_rows($result)>0 && $row=mysqli_fetch_assoc($result))
                $content = $row["content"];
            if(strlen($content) > 0 || ($_SESSION["userLevel"] > $_userType["student"]))
                include_once("includes/modals/announcement.php");
            if($_SESSION["userLevel"] == $_userType["parent"])
                include_once("includes/modals/newStudentConnection.php");
            if($_SESSION["userLevel"] >=$_userType["sponsor"])
                include_once("includes/modals/confirmDeletion.php");
        ?>
        <div id="main">
            <!-- sad :( -->
            <?php $img=5; //4pm -> 8pm && 5am -> 7am
                /*$hour=date("H");
                if ($hour >=20 || $hour < 5) //8pm -> 5am
                    $img=2;
                else if ($hour >=7 && $hour < 16) //7am -> 4pm
                    $img=0; //change this to 0*/
            ?>
            <!--<img src="images/sky/<?php echo $img; ?>.jpg" class="img-responsive" id='skyBackground'/>-->
            <div class="in font-disney color-white text-center" id='welcomeText'>
                <div style="font-size: 5em;">Senior Disney Trip</div>
                <div style="font-size: 2.5em;">
                    Welcome<?php
                    if(isset($_SESSION["fName"])) echo " ".ucfirst($_SESSION["fName"]);
                    if(isset($_SESSION["lName"])) echo " ".ucfirst($_SESSION["lName"]);
                    if($_SESSION["userLevel"] == $_userType["parent"]) echo "'s Parent/Guardian";
                    ?>!
                </div>
            </div>
        </div>
        <?php include_once("includes/fireworks.php"); ?>
        <?php include_once("includes/coaster.php"); ?>
        <div class="row margin-0 background-white" id="top">
            <div class="col-xs-12" style="height: 30px"></div>
            <div class="col-xs-12 col-md-10 col-md-push-1" style="padding: 0px 25px">
            <?php
                if( floor($_SESSION["userLevel"]) == $_userType["new"]) include_once("includes/modals/newUser.php");
                
                /* includes the main pages of our site */
                include_once($_PAGE.".php"); unset($_GET);
                if($_PAGE !="home"){ ?>
                    <script>
                        $(function(){
                            if( $("#coaster").offset().top - window.scrollY > 0)
                                scroll($('#top'));
                        });
                    </script>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php
            include_once("includes/footer.php");
        ?>
    </body>
    <!-- Bootstrap Javascript Library -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- JQuery Plugin Library -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Stick Header / FloatHead-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/2.1.3/jquery.floatThead.js"></script>
</html>