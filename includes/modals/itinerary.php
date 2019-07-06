<div class="modal fade" id="itineraryModal" tabindex="-1" role="dialog" aria-labelledby="itineraryModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body container-fluid" style="paddding: 0px 20px"></div>
        </div>
    </div>
</div>
<script>
    $("#itineraryModal").on('show.bs.modal', function (){
        $.ajax({
            url: "scripts/connection.php?../files/itinerary.php",
            success: function(response){
                $("#itineraryModal .modal-body").html(response);
            }
        });
    });
</script>