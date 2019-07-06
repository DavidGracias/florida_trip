<div class="modal fade" id="userFunctions" role="dialog" id-target="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body row">
                <div class="col-xs-12">
                    <button style="margin-bottom: 15px" class="btn btn-danger pull-right" data-dismiss="modal">
                        <span class="fas fa-times"></span>
                    </button>
                </div>
                <div style="position: relative" class="col-xs-12 row" data-spy="scroll" data-target="#userFunctionsNav" data-offset="30">
                    <nav class="col-xs-12 col-sm-3 navbar background-white" id="userFunctionsNav">
                        <ul class="nav nav-pills nav-xs-vertical" style="position:fixed; top:20px;">
                            <?php
                            $functions=array(
                                $_userType["admin"]=> array("profile", "trip", "itinerary", "assignments", "admins",),
                                $_userType["sponsor"]=> array("profile", "trip", ),
                                $_userType["chaperone"]=> array("profile"),
                                $_userType["student"]=> array("profile", ),
                            );
                            for($i=0; $i < count($functions[$_SESSION["userLevel"]]); $i++){
                                $id=$functions[$_SESSION["userLevel"]][$i]; ?>
                                <li class=' <?php if($i == 0) echo "active"; ?>'>
                                    <a href="#<?php echo $id; ?>">
                                        <?php echo ucwords($id); ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                    <div class="col-xs-12 col-sm-9 content">
                        <?php include_once("includes/userFunctions/".array_search($_SESSION["userLevel"], $_userType).".php"); 
                        //include_once("includes/userFunctions/sponsor.php");
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function userFunctions(id){
        $("#userFunctions").attr("id-target", id);
        $('#userFunctions').modal({
            backdrop: 'static',
            keyboard: true,
            show: true,
        });
    }
    $(document).ready(function(){
        $("#userFunctions").on('shown.bs.modal', function(){
            var id=$(this).attr("id-target");
            var container=$(this).find('[data-spy="scroll"]');
            if(id !=""){
                container.dequeue()
                .animate({
                    scrollTop: $("#"+id).offset().top - container.offset().top + container.scrollTop(),
                }, 1000);
                $(this).attr("id-target", "");
            }
            else
                container.dequeue().animate({
                    scrollTop: "1px",
                }, 1);
        });//end of userFunctions modal.shown
        
        $("#userFunctions form").submit(function(){
            var successNode=$(this).find("button[value='submit']").parent().find(".alert-success");
            var errorNode=$(this).find("button[value='submit']").parent().find(".alert-danger");
            var postData={
                "table": $(this).attr("data-table"),
                // "where-adminID": $(this).parent().attr("data-id"),
            };
            var attr=$(this)[0].attributes;
            for(var z=0; z < attr.length; z++){
                if(attr[z].name.indexOf("where-") > -1)
                    postData[attr[z].name]=attr[z].value;
            }
            $(this).find(":input").each(function(){
                if($(this).val() == "submit")
                    return;
                var name=$(this).attr("name");
                if(name.indexOf("-time") > -1){
                    var value=$(this).val().toLowerCase();
                    var valArr=value.split(":");
                    valArr[2]="00";
                    for(var i=0; i < valArr.length; i++)
                        valArr[i]=parseInt(valArr[i], 10);
                    if(value.indexOf("p") > -1 && valArr[0] !=12)
                        valArr[0]+=12;
                    for(var x=0; x < valArr.length; x++)
                        while((valArr[x]+"").length < 2)
                            valArr[x]="0"+valArr[x];
                    postData[name.substr(0, name.indexOf("-time"))] +=" "+valArr.join(":");
                }
                else
                    postData[name]=$(this).val();
            });
            $(this).find(".input-select").each(function(){
                var value=$(this).find(".select.active").attr("data-value");
                postData[$(this).attr("name")]=value;
            });
            
            $.ajax({
                url: 'scripts/connection.php?updateValues.php',
                type: 'POST',
                data: postData,
                success: function(response){
                    errorNode.dequeue();
                    successNode.dequeue();
                    successNode.css("opacity", "1");
                    successNode.animate({
                        opacity: 0,
                    }, 2000);
                },
                error: function(){
                    successNode.dequeue();
                    errorNode.dequeue();
                    errorNode.css("opacity", "1");
                    errorNode.animate({
                        opacity: 0,
                    }, 2000);
                }
            });
            return false;
        });//saving parts of the 
    });//end of document.ready()
</script>