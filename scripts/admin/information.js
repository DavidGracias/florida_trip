$(document).ready(function(){
    /* Adding Packing Item */
    $(document).on("click", ".addPackingItem", function(){
        if($(this).parent().find(".addPackingInput").length > 0)
            return;
        var inputNode=$('<div></div>').addClass("padding-1 input-group").addClass("addPackingInput").css("margin", "0px 0px 4px 0px");
        var input=$('<input type="text" placeholder="New Item"/>').addClass("form-control").css("padding", "0px 7.5px");
        var span=$('<span></span>').addClass("pointer background-blue color-white input-group-addon").append($('<i></i>').addClass("fas fa-check"));
        inputNode.append(input).append(span);
        var parent=$(this).parent().find('.packingItem');
        //insert before
        parent.first().before(inputNode);
    });
    $(document).on("click", ".packing-list .input-group-addon", function(){
            if($(this).prev().val() !=""){
                var similar=$(this).parent().parent().find(".packingItem").last().clone(true);
                similar.children().last().text($(this).prev().val());
                //insert before
                $(this).parent().parent().find(".packingItem").first().before(similar);
                var List=$(this).parent().parent().parent();
                var category=( $('#listPic').attr('src').indexOf('female') == -1 )? "content" : "extra";
                updatePackingList(List, category);
            }
            $(this).parent().remove();
        });
    
    /* Deleting Packing Item */
    $(document).on("click",".packingItem .fa-times", function(){
        var List=$(this).parent().parent().parent().parent();
        var category=( $('#listPic').attr('id').indexOf('female') == -1 )? "content" : "extra";
        $(this).parent().parent().remove();
        updatePackingList(List, category);
    });
    
    /* Sorting / Ordering Packing Items */
    $('.packingItem').parent().css("overflow", "auto").sortable({
        helper: "clone",
        update: function(event, ui){
            var List=(ui.item).parent().parent();
            var category=( $('#listPic').attr('id').indexOf('female') == -1 )? "content" : "extra";
            updatePackingList(List, category);
        }
    });
});
function updatePackingList(desc, category){
    var postData={};
    postData[category]="";
    desc.find(".packingItem").each(function(){
        var text=$(this).children().last().text().replace(/^\s+|\s+$/gm,'');
        if(text.split(' ').join('').length > 0)
        postData[category]+=text+"\n";
    });
    postData["where-desc"]=desc.attr('id').substring(0, desc.attr('id').length-2);
    
    postData["table"]="general";
    $.ajax({
        url: 'scripts/connection.php?updateValues.php',
        type: 'POST',
        data: postData,
    });
}