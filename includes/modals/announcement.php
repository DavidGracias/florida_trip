<?php
$result=mysqli_query($conn, "SELECT * FROM `general` WHERE `desc`='announcement'");
$info="";
if( mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result) ){
    $info=$row["content"];
}
if( strlen( str_replace(" ", "", $info) ) != 0){
?>

<div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h3 class="modal-title text-center">Today's Announcements - </span><?php echo date("F jS"); ?></h3>
            </div>
            <div class="modal-body" style='white-space:pre-wrap; min-height: 25vh; font-size: 1.2em'><?php
                echo $info;
            ?></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" onclick="clearAnnouncement();">Don't Show Again</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script>
$(document).ready(function(){
    <?php if($_SESSION["userLevel"] == $_userType["student"] && !$testing && !isset($_SESSION["announcement"]) && strlen($info) > 0){ ?>
        $("#announcementModal").modal();
    <?php } ?>
});
function clearAnnouncement(){
    $.ajax({
        url: 'scripts/connection.php?announcement.php',
    });
}
</script>