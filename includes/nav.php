<nav class="navbar navbar-fixed-top" id="nav">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navLinks">
                <span class="fas fa-bars fa-lg"></span>
            </button>
            <div class="display-none navbar-brand display-inline padding-0" style="margin-left:-10px;">
                <!--<img src="images/logo.png" height="100%"/>-->
            </div>
            <div class="navbar-brand font-disney display-inline hidden-sm" style="white-space: nowrap; font-size: 3em !important">
                PWHS Disney
            </div>
        </div>
        <div  class="collapse navbar-collapse" id="navLinks">
            <ul class="nav navbar-nav navbar-right pull-right">
                <li class="<?php if($_PAGE == "home") echo "active"; ?>">
                    <a href="index.php" class="border-bottom">
                        HOME
                    </a>
                </li>
                <?php if($_SESSION["userLevel"] >=$_PAGES["finances"]){ ?>
                    <li class="<?php if($_PAGE == "finances") echo "active"; ?>">
                        <a href="index.php?finances" class="border-bottom">
                            FINANCES
                        </a>
                    </li>
                <?php }
                if($_SESSION["userLevel"] >=$_PAGES["students"]){ ?>
                    <li class="<?php if($_PAGE == "students") echo "active"; ?>">
                        <a href="index.php?students" class="border-bottom">
                            STUDENTS
                        </a>
                    </li>
                <?php }
                if($_SESSION["userLevel"] >= $_userType["chaperone"]){ //$_PAGES["assignments"] ?>
                    <li class="<?php if($_PAGE == "assignments") echo "active"; ?>">
                        <a href="index.php?assignments" class="border-bottom">
                            ASSIGNMENTS
                        </a>
                    </li>
                <?php }
                if($_SESSION["userLevel"] >=$_PAGES["information"]){ ?>
                    <li class="<?php if($_PAGE == "information") echo "active"; ?>">
                        <a href="index.php?information" class="border-bottom">
                            INFORMATION
                        </a>
                    </li>
                <?php }
                if($_SESSION["userLevel"] >=$_PAGES["calendar"]){ ?>
                    <li class="<?php if($_PAGE == "calendar") echo "active"; ?>">
                        <a href="index.php?calendar" class="border-bottom">
                            CALENDAR
                        </a>
                    </li>
                <?php } ?>
                <li style="margin-top: 5px;" id='profileLinkListItem'>
                <?php if($_SESSION["userLevel"] == $_userType["unsigned"]){ ?>
                    <a href="javascript:void(0);" class="g-signin2" data-onsuccess="onSignIn" id="googleSignIn">
                            <!-- GOOGLE SIGN IN -->
                            <script> /*
                                gapi.signin2.render('googleSignIn', {
                                    'scope': 'profile email',
                                    'width': 35,
                                    'height': 35,
                                    'longtitle': false,
                                    'theme': 'dark',
                                    'onsuccess': onSignIn,
                                }); */
                            </script>
                        </a>
                <?php } else{ ?>
                    <div class="dropdown">
                        <div class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <?php echo strtoupper(array_search($_SESSION["userLevel"], $_userType)); ?>
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <ul class="dropdown-menu background-white" >
                            <?php
                            if($_SESSION["userLevel"] == $_userType["parent"]){
                                $parentResult = mysqli_query($conn, "SELECT * FROM `students` WHERE INSTR(`altEmail`, '{$_SESSION['altEmail']}') > 0");
                                $counter=1;
                                if(mysqli_num_rows($parentResult) > 0){
                                    $switchStudents = array();
                                    while($parentRow = mysqli_fetch_assoc($parentResult)){
                                        if($counter == $_SESSION["row"])
                                            $current = $parentRow["fName"]." ".$parentRow["mName"]." ".$parentRow["lName"];
                                        else
                                            $switchStudents[$counter] = $parentRow["fName"]." ".$parentRow["mName"]." ".$parentRow["lName"];
                                        $counter++;
                                    }
                                    echo "<li class='padding-2'>
                                            <div class='center-block fa-sm' style='color: #777; font-weight: 200'>Currently Viewing:
                                                <div class='bold'>{$current}</div>
                                            </div>
                                        </li>";
                                    if(count($switchStudents) > 0)
                                        echo '<li class="dropdown-header text-center" style="padding-bottom:0px; font-weight: 200">Switch to:</li>';
                                    foreach($switchStudents as $key => $value){
                                        echo "<li class='padding-4'>";
                                        echo "<div class='btn btn-primary center-block' onclick='switchStudent({$key})'>{$value}</div>";
                                        echo "</li>";
                                    }
                                } ?>
                                <li class="divider"></li>
                                <li class="padding-2">
                                    <div class='btn btn-primary center-block' data-toggle="modal" data-target="#newStudentConnectionModal">
                                        Add Child(ren)
                                    </div>
                                </li>
                                <script>
                                    function switchStudent(counter){
                                        $.ajax({
                                            url: "scripts/connection.php?switchStudent.php",
                                            type: "POST",
                                            data: { "row": counter, },
                                            success: function(response){
                                                $.ajax({
                                                    url: "scripts/connection.php?logScript.php",
                                                    success: function(response){
                                                        var auth2=gapi.auth2.getAuthInstance();
                                                        var profile=auth2.currentUser.get().getBasicProfile();
                                                        $.ajax({
                                                            url: "scripts/connection.php?logScript.php",
                                                            type: "POST",
                                                            data: profile,
                                                            success: function(response){
                                                                if(response == "Email 404"){
                                                                    $.ajax({
                                                                        url: "scripts/connection.php?logScript.php",
                                                                        type: "POST",
                                                                        data: {
                                                                            U3: profile.getEmail(),
                                                                        },
                                                                    });
                                                                }
                                                                window.location.reload();
                                                            },
                                                        });
                                                    },
                                                });
                                            }
                                        });
                                    }
                                </script>
                            <?php }
                            else{
                                echo '<li class="dropdown-header text-center">User Functions:</li>';
                                for($i=0; $i < count($functions[$_SESSION["userLevel"]]); $i++){
                                    $id=$functions[$_SESSION["userLevel"]][$i]; ?>
                                    <li>
                                        <a href="javascript: userFunctions('<?php echo $id; ?>');">
                                            <?php echo ucwords($id); ?>
                                        </a>
                                    </li>
                            <?php }
                            } ?>
                                
                            <li class="divider"></li>
                            
                            <li class="dropdown-header text-center" style="font-weight: 200">
                                Goodbye, <?php echo ucwords(array_search($_SESSION["userLevel"], $_userType)); ?>!
                            </li>
                            <li class="padding-2">
                                <a class="btn btn-primary" id="signOut" href="javascript: signOut();" >
                                    SIGN OUT
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--<a id="signoutbtn" onclick="signOut()" class="visible-xs" href="javascript: signOut();">-->
                    <!--    <div class="btn btn-primary">-->
                    <!--        SIGN OUT-->
                    <!--    </div>-->
                    <!--</a>-->
                <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>