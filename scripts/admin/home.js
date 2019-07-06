$(document).ready(function(){
    /* FAQ */
    $(document).on("click", ".faq-new-category, .faq-new-question", function(e){
        if( !$(e.target).is($(this).children().first()))
            return;
        slideNext($(e.target), $(e.target).next());
    });
    $(document).on("click", ".faq-new-question .btn, .faq-new-category .btn", function(){
        var inputs=$(this).parent().parent().find("input");
        
        inputs.each(function(){
            if($(this).val() == "" && $(this).queue().length == 0)
                $(this).animate({ backgroundColor: "#FFBBBB"}, 1000).animate({ backgroundColor: "#FFFFFF"});
        });
    });
    
    /* FAQ New Question */
    $(document).on("click", "#FAQ .faq-new-question .btn", function(){
        var FAQBody=$(this).parent().parent();
        var inputs=$(this).parent().parent().find("input");
        for(var x=0; x < inputs.length; x++){
            if(inputs.eq(x).val() == "")
                return;
        }
        $.ajax({
            url: "scripts/connection.php?insertInto.php",
            type: "POST",
            data: {
                table: "faq",
                category: $(this).attr("data-category"),
                question: inputs.eq(0).val(),
                answer: inputs.eq(1).val(),
            },
            success:function(response){
                alert(response);
                var where=response.split(":::");
                var text='\
<div class="faq-questions panel-body color-black padding-0 vertical-align flex-nowrap" data-type="deleteable">\
    <div style="height: 100%; margin: 0px;" class="top pull-left padding-3 vertical-align flex-nowrap" data-type="slideable" data-target="[data-type=\'slideTarget\']" data-parent="1">\
        <span class="top btn padding-1">\
            <aside data-parent="3" data-type="delete">\
                <i class="fas fa-times"></i>\
            </aside>\
        </span>\
        <span class="top btn background-purple" style="padding: 1px 2px 1px 3px; margin: 0px 4px">\
            <aside data-parent="3" data-type="edit">\
                <i class="fas fa-edit"></i>\
            </aside>\
        </span>\
    </div>\
    <div class="flex-grow">\
        <div class="pointer flex-start flex-nowrap container-fluid" style="padding:15px;">\
            <span class="top bold" style="padding-right: 4px">Q: </span>\
            <span class="flex-grow top" data-table="faq" data-field="question" where-'+where[0]+'="'+where[1]+'" data-type="editable">';
                text+=inputs.eq(0).val();
            text+='</span>\
            <span class="fa-lg fas fa-angle-double-down pull-right padding-2" style="margin-top:4.5px"></span>\
        </div>\
        <div class="display-none" data-type="slideTarget">\
            <hr/>\
            <div class="no-pointer tab flex-start flex-nowrap" style="padding:15px">\
                <span class="top bold" style="padding-right: 4px">A: </span>\
                <span class="flex-grow top tab-off" data-table="faq" data-field="answer" where-'+where[0]+'="'+where[1]+'" data-type="editable">';
                    text+=inputs.eq(1).val();
                text+='</span>\
            </div>\
        </div>\
    </div>\
</div>';
                FAQBody.parent().parent().append($(text));
                slideNext(FAQBody.prev(), FAQBody);
                for(var x=0; x < inputs.length; x++)
                    inputs.eq(x).val("");
            },
        });
    });
    
    /* FAQ New Category */
    $(document).on("click", "#FAQ .faq-new-category .btn", function(){
        var inputs=$(this).parent().parent().find("input");
        
        for(var x=0; x < inputs.length; x++)
            if(inputs.eq(x).val() == "")
                return;
        var node=$(".FAQ-category").eq(0).clone(true);
        node.children().first().addClass("background-yellow-orange").children().first().text(inputs.eq(0).val());
        node.children().eq(1).children(".faq-questions").remove();
        node.children().eq(1).find("[data-desc]").attr("data-desc", "FAQ-"+inputs.eq(0).val());
        $(".faq-new-category").first().after(node);
        node.find(".display-none").eq(0).removeClass("display-none");
        slideNext( node.find(".faq-new-question").children().eq(0), node.find(".faq-new-question").children().eq(1));
        inputs.eq(0).val("");
        slideNext($(".faq-new-category").children().first(), $(".faq-new-category").children().first().next());
    });
});