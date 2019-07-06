<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title display-inline">Add New Student Profile</h4>
            </div>
            <form class="modal-body">
                
                <div class="input-group padding-3">
                    <span class="input-group-addon background-blue color-white">Student ID</span>
                    <input class="form-control input" type="text" name="studID" placeholder="Student ID"/>
                </div>
                
                <div class="input-group padding-3">
                    <div class="input-group-addon background-blue color-white" style="padding-right: 25px">
                        Name
                    </div>
                    <div class="flex-grow flex-stretch">
                        <input type="text" class="form-control input" name="fName" placeholder="First" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;"/>
                        <input type="text" class="form-control input" name="mName" placeholder="Middle"/>
                        <input type="text" class="form-control input" name="lName" placeholder="Last"/>
                    </div>
                </div>
                
                <div class="input-group padding-3">
                    <span class="input-group-addon background-blue color-white">Email</span>
                    <input class="form-control input" type="email" name="email" placeholder="firstName.lastName"/>
                    <span class="input-group-addon background-blue color-white">@student.colonialsd.org</span>
                </div>
                
                <div class="row padding-3 flex-nowrap">
                    <div class="input-group padding-3 col-xs-6">
                        <span class="input-group-addon background-blue color-white">Gender</span>
                        <select class="form-control text-center" name="gender">
                            <option selected="true" disabled="disabled"> -- Select an Option -- </option>
                            <option value="0" class="color-black">Male</option>
                            <option value="1" class="color-black">Female</option>
                            <option value="2" class="color-black">Other</option>
                        </select>
                    </div>
                    
                    <div class="input-group padding-3 col-xs-6">
                        <span class="input-group-addon background-blue color-white">Graduation Year</span>
                        <input class="form-control input" type="text" name="gradYear" placeholder="20XX"/>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <div type="button" class="btn btn-success pull-left" data-type="confirm">Confirm</div>
                <div type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancel</div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#newUserModal [name='fName'], #newUserModal [name='lName']").keyup(function(){
            var value=$("#newUserModal [name='fName']").val()+"."+$("#newUserModal [name='lName']").val();
            if(value.length > 1)
            $("#newUserModal [name='email']").val(value.toLowerCase());
        });
        $("#newUserModal [data-dismiss='modal']").click(function(){
            $("#newUserModal input").val("");
            $("#newUserModal select").prop("selectedIndex", 0);
        });
        $("#newUserModal [data-type='confirm']").click(function(){
            var isValid=true;
            var postData={
                table: "students"
            };
            $("#newUserModal :input").each(function(){
                if( $(this).attr("name") == "mName")
                    "";
                else if($(this).val() == "" || $(this).val() == null){
                    $(this).dequeue().animate({backgroundColor: "#FFBBBB"}).animate({backgroundColor: "#FFFFFF"});
                    isValid=false;
                }
                postData[$(this).attr("name")]=$(this).val();
            });
            if(postData["email"].indexOf("@") == -1)
                postData["email"]+="@student.colonialsd.org"
                
            if(isValid)
                $.ajax({
                    url: "scripts/connection.php?insertInto.php",
                    type: "POST",
                    data: postData,
                    success: function(response){
                        if(response.indexOf(":::") == -1)
                            alert("Contact an administrator for help. \n\nError Code: "+response);
                        else
                            window.location.reload();
                    }
                });
        });
    });
</script>