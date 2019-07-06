<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h4 class="modal-title">Edit Roommates</h4>
            </div>
            <div class="modal-body">
                <?php for($i = 1; $i <= 4; $i++ ){ ?>
                    <div class="input-group">
                        <div id = "roomId<?php echo $i ?>" class="input-group-addon background-blue color-white content">
                            Student <?php echo $i; ?>
                        </div>
                        <input class="form-control roomEdit" id ="roomKid<?php echo $i ?>" type="text" class="form-control input" placeholder="Roommate <?php echo $i; ?>"/>
                    </div>
                    <br/>
                <?php } ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    var availableTags;
    $( function(){
        availableTags=[ <?php
            $notGender="-1";
            $result=mysqli_query($conn, "SELECT * FROM `students` WHERE seniorTripContract=1");
            // if(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){
            //     $notGender=abs( intval($row["gender"])-1 );
            // }
            // $where="";//idk what to put here
            // $result=mysqli_query($conn, "SELECT * FROM `students` ".$where);
            while(mysqli_num_rows($result) > 0 && $row=mysqli_fetch_assoc($result)){ ?>
                {
                    value: "<?php echo ucwords($row["fName"]." ".$row["mName"]." ".$row["lName"]); ?>",
                    label: "<?php echo ucwords($row["fName"]." ".$row["mName"]." ".$row["lName"]); ?>",
                    desc: "(<?php echo $row["studID"]; ?>)",
                },
            <?php } ?>
        ];
        $("#roomModal input").autocomplete({
            minLength: 1,
            source: availableTags,
            focus: function( event, ui ) {
                $(this).val( ui.item.label );
                $(this).prev().text( ui.item.desc.substring(1, ui.item.desc.length-1) );
            return false;
          },
        }).autocomplete( "instance" )._renderItem=function( ul, item ) {
              return $( "<li>" )
                .append( "<div>" + item.label + "<br>" + item.desc + "</div>" )
                .appendTo( ul );
        };
    });
    $(document).ready(function(){
        $(".roomEdit").keyup(function(){
            var elem = $(this).prev();
            for(var i = 0; i < availableTags.length; i++){
                var obj = availableTags[i];
                if(obj.value == $(this).val()){
                    elem.text(obj.desc.substr(1,5));
                    return;
                }
            }
            var roomNum = $(this).attr("id").substr(7);
            elem.text("Student "+roomNum);
        });
    });
    
</script>