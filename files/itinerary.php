<div class="text-center h4">
    PLYMOUTH WHITEMARSH HIGH SCHOOL<br/>
    SENIOR CLASS TRIP - ORLANDO, FLORIDA<br/>
</div>
<?php
    $result=mysqli_query($conn, "SELECT * from `itinerary` ORDER BY `dateTime` ASC");
    while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
        $date=strtotime($row['dateTime']);
        if ($prev !=substr($row['dateTime'], 0, 10)){ ?>
            <div class='h3 col-xs-12 text-center color-blue' style="margin-top: 25px">
                <?php echo date("l, F jS", $date); ?>
            </div>
        <?php } ?>
        <div class='col-xs-12 col-md-10 col-md-push-1 color-black vertical-align flex-nowrap'>
            <span class='color-blue bold padding-4 text-center' style="width:100px;  white-space: nowrap;">
                <?php echo date("h:i A", $date); ?> -
            </span>
            <div class="display-inline">
                <?php echo $row['description']; ?>
            </div>
        </div>
        </br>
    <?php
        $prev=substr($row['dateTime'], 0, 10);
    }
?>
<br/><br/>