<div class="modal fade" id="busChapModal" tabindex="-1" role="dialog" aria-labelledby="busChapModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h3 class="modal-title text-center">Edit Bus/Chaperone</h3>
            </div>
            <div class="modal-body">
                <select id='eChap' class='form-control'>
                    <option selected disabled>Select Chaperone</option>
                    <?php
                    $chaps=mysqli_query($conn,"SELECT * from chaperones");
                   while($chap=$chaps->fetch_assoc()){
                        echo "<option value='".$chap['chapID']."'>";
                        echo $chap['fName']." ".$chap['mName']." ".$chap['lName'];
                        echo "</option>";
                    }
                    ?>
                </select><br/>
                <input type='number' id='eBus' class='form-control' placeholder='Select Bus #' />
                <h5 class='text-danger'>*The roommates of the selected students will also be affected.</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-right" id='submitAssign'>Submit Changes</button>
            </div>
        </div>
    </div>
</div>
<script>
function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}
$('#submitAssign').click(function(){
    $bus=$('#eBus').val();
    $chap=$('#eChap').val();
    $students=new Array();
    $('.box').each(function(){
        if($(this).prop('checked')){
            $id=$(this).parent().parent().attr('title');
            $students.push($id);
        }
    });
    $studs=JSON.stringify($students);
    $.ajax({
       url:"scripts/connection.php?busChapUpdate.php",
       type:"POST",
       data:{
           studs:$studs,
           bus:$bus,
           chap:$chap
       },
       success:function(data){
           $studs=""+data;
           $studs=$studs.split(",");
           $ids=new Array();
           $success=new Array();
           $fail=new Array();
           for($x=0;$x<$studs.length;$x++){
               if($studs[$x].indexOf("$")!=-1){
                   $success.push($studs[$x].substring(1));
                   $ids.push($studs[$x+1]);
               }
               else{
                   $fail.push($studs[$x]);
               }
               $x+=1;
           }
           $success=$success.filter(onlyUnique);
           $ids=$ids.filter(onlyUnique);
           if($success.length>0){
               $alert="<div class='alert alert-success'> The students "+$success.toString()+" have been successfully updated.</div>";
               $('#busChapModal .modal-body').prepend($alert);
           }
           if($fail.length > 1){
               $alert="<div class='alert alert-danger'>The students "+$fail.toString()+" do not have rooms and cannot be adjusted at this time.</div>";
               $('#busChapModal .modal-body').prepend($alert);
           }
           window.setTimeout(function(){$('#busChapModal .alert').remove();},20000);
           //update table display
           $chapT=$('#eChap option:selected').text();
           $('#studTbl tr').each(function(){
               $title=$(this).attr('title');
               
               for($x=0;$x<$ids.length;$x++){
                   if($title==$ids[$x]){
                       
                       $(this).find(".chap").text($chapT);
                       $(this).find(".bus").text($bus);
                       $(this).find(".chap").val($chapT);
                       $(this).find(".bus").val($bus);
                       break;
                   }
               }
           });
           $('#editBus').text("Edit Bus/Chaperone");
           $('.box').parent().addClass("display-none");
           $('#boxCol').addClass("display-none");
       }
    });
})
</script>