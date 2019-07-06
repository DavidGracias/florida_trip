<div class="modal fade" id="newStudentConnectionModal" tabindex="-1" role="dialog" aria-labelledby="newStudentConnectionModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <span class="fas fa-times"></span>
                </button>
                <h3 class="modal-title">
                    Add Child Account
                </h3>
            </div>
            <form class="modal-body">
                <h4>Link Student to Account</h4>
                <div class="col-xs-12 padding-0 input-group">
                    <div class="input-group-addon background-blue color-white">
                        <span class="input-group-text">
                            Student ID
                            <span class="fas fa-asterisk"></span>
                        </span>
                    </div>
                    <div class="flex-grow">
                        <input name="studID" class="form-control input" type="text" placeholder="5-Digit Identifier (given by school)"/>
                    </div>
                </div>
                <br/>
                
                <div class="col-xs-12 padding-0 input-group vertical-align flex-nowrap">
                    <div class="input-group col-xs-6 col-sm-5">
                        <span class="input-group-addon background-blue color-white">
                            Gender
                            <span class="fas fa-asterisk"></span>
                        </span>
                        <select class="form-control text-center" name="gender">
                            <option selected="true" disabled="disabled"> -- Select an Option -- </option>
                            <option value="0" class="color-black">Male</option>
                            <option value="1" class="color-black">Female</option>
                            <option value="2" class="color-black">Other</option>
                        </select>
                    </div>
                    <div class="hidden-xs col-sm-1"></div>
                    <div class="input-group col-xs-6">
                        <span class="input-group-addon background-blue color-white">
                            Graduation Year
                            <span class="fas fa-asterisk"></span>
                        </span>
                        <input class="form-control input" type="text" name="gradYear" placeholder="20XX"/>
                    </div>
                </div>
                <br/>
                
                <div class="col-xs-12 padding-0 input-group">
                    <div class="input-group-addon background-blue color-white">
                        <span class="input-group-text">
                            Student Email
                            <span class="fas fa-asterisk"></span>
                        </span>
                    </div>
                    <div class="flex-grow">
                        <input name="email" class="form-control input" type="email" placeholder="school.email@student.colonialsd.org"/>
                    </div>
                </div>
                <br/>
                <div class="modal-footer">
                    <button type="submit" value="submit" class="btn btn-primary pull-right">Submit</button>
                    <div class="clear"></div>
                </div>
                <script>
                        function validate(){
                            var json = {};
                            var isValid = true;
                            
                            var studID=$("#newStudentConnectionModal form [name='studID']");
                            if(studID.val().length != 5){
                                studID.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid = false;
                            }
                            else json["studID"] = studID.val();
                            
                            var gender=$("#newStudentConnectionModal [name='gender']")
                            if(gender.selectedIndex == 0){
                                $("#newStudentConnectionModal [name='gender']").dequeue().animate({ color: "#FFBBBB"}).animate({ color: "#FFFFFF"});
                                isValid = false;
                            }
                            else json["gender"] = gender.val();
                            
                            var gradYear=$("#newStudentConnectionModal form [name='gradYear']");
                            if(gradYear.val().length != 4){
                                gradYear.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid = false;
                            }
                            else json["gradYear"] = gradYear.val();
                            
                            var email=$("#newStudentConnectionModal form [name='email']");
                            if(email.val().length == 0){
                                email.dequeue().animate({ backgroundColor: "#FFBBBB"}).animate({ backgroundColor: "#FFFFFF"});
                                isValid = false;
                            }
                            else json["email"] = email.val();
                            
                            return (isValid)? json : false;
                        }
                        $(document).ready(function(){
                            $("#newStudentConnectionModal form").submit(function(){
                                var valid=validate();
                                if(valid !== false)
                                    $.ajax({
                                        type: "POST",
                                        url: "scripts/connection.php?newParent.php",
                                        data: valid,
                                        success:function(response){
                                            if(parseInt(response, 10) == 0){
                                                alert("The information provided does not match the information of any student within our database, please verify that your information is correct and try again!")
                                                // no students found
                                                return;
                                            }
                                            else
                                                $.ajax({
                                                    url: "scripts/connection.php?logScript.php",
                                                    success: function(){
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
                                                                alert("You have successfully linked your email to this student account!");
                                                                window.location.reload();
                                                            },
                                                        });
                                                    },
                                                });
                                        },
                                    });
                                return false;
                            });
                        })
                    </script>
            </form>
            
        </div>
    </div>
</div>