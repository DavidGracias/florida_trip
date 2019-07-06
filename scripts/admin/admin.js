$(document).ready(function(){
    /* EDITING */
    $(document).on("click", "[data-type='edit']", function(){
        var parent=$(this);
        for(var x=$(this).attr("data-parent"); x > 0; x--)
            parent=parent.parent();
        
        var target=parent.find("[data-type='editable']");
        var hidden=parent.find($('[data-type="slideTarget"]'));
        var display=hidden.css('display');
        hidden.css("display", "block");
        target.each(function(){
            var attrs={};
            $.each( this.attributes, function ( index, attribute ) {
                attrs[attribute.name]=attribute.value;
            } );
            
            var suggestedWidth=$(this).parent().outerWidth()-10
            - parseInt($(this).parent().css("padding-left"), 10)
            - parseInt($(this).parent().css("padding-right"), 10);
            $(this).siblings().each(function(){
                suggestedWidth -=($(this).width() + parseInt($(this).css("margin"), 10) );
            });
            var suggestedHeight=$(this).height()+6*2;
            var textbox=$("<textarea></textarea>")
                .css("min-width", $(this).width())
                .css("min-height", Math.max(suggestedHeight, 32))
                .css("height", suggestedHeight)
                .css("font-size", ".975em")
                .css("text-indent", $(this).css("text-indent"))
                .css("display", "inline-block")
                .addClass("form-control")
                .attr("data-type", "saveable")
                .attr("data-tagName", $(this).prop("tagName"))
                .attr("data-attributes", JSON.stringify(attrs))
            if( parent.hasClass("faq-questions") ) // || parent.parent().hasClass("faq-questions")
                textbox
                    .css("height", suggestedHeight + 6*2)
                    .css("display", "block")
                    .css("width", "auto")
                    .css("padding-left", "7px")
                    .addClass("flex-grow");
            if($.contains( document.getElementById("footer"), $(this)[0] ))
                textbox.css("height", "24px").css("padding", "3px");
            
            textbox.val($(this).text());
            //if date -- if number
            $(this).replaceWith(textbox);
        });
        hidden.css("display", display);
        $(this).replaceWith($("<aside></aside>")
            .attr("data-parent", $(this).attr("data-parent"))
            .attr("data-type", "save")
            .text(($(this).text().indexOf("Edit") > 0)? " Save" : "" )
            .prepend("<i class='fas fa-save'></i>")
        );
    });
    
    /* SAVING */
    $(document).on("click", "[data-type='save']", function(){
        var parent=$(this);
        for(var x=$(this).attr("data-parent"); x > 0; x--)
            parent=parent.parent();
        
        var target=parent.find("[data-type='saveable']");
        
        target.each(function(){
            var updated=$(this).val();
            var tag=$(this).attr("data-tagName");
            var node=$("<"+tag+"></"+tag+">").text( updated );

            var attr=JSON.parse( $(this).attr("data-attributes"));
            var postData={
                table: attr["data-table"],
            };
            postData[attr["data-field"]]=updated;
            for(var key in attr ){
                if( key.indexOf("where") > -1)
                    postData[key]=attr[key];
                node.attr(key, attr[key]);
                if( key == "href" && attr[key].indexOf("tel") > -1)
                    node.attr(key, "tel:"+node.text().replace(/\D/g, "")); //fixes telephones
            }
            
            $.ajax({
                url: "scripts/connection.php?updateValues.php",
                type: "POST",
                data: postData,
            });
            
            $(this).replaceWith( node );
        });
        
        $(this).replaceWith($("<aside></aside>")
            .attr("data-parent", $(this).attr("data-parent"))
            .attr("data-type", "edit")
            .text(($(this).text().indexOf("Save") > 0)? " Edit" : "" )
            .prepend("<i class='fas fa-edit'></i>")
        );
    });
    
    /* DELETING */
    $deleteObject=undefined;
    $(document).on("click", "[data-type='delete']", function(){
        var parent=$(this);
        for(var x=$(this).attr("data-parent"); x > 0; x--)
            parent=parent.parent();
        
        if( !confirmDeletion($(this), parent) ) return;
        
        var target=parent.find("[data-type='editable'], [data-type='saveable']");
        
        target.each(function(){
            var attrs={};
            if($(this).attr("data-attributes")===undefined){
                $.each( this.attributes, function ( index, attribute ) {
                    attrs[attribute.name]=attribute.value;
                } );
            }
            else
                attrs=JSON.parse( $(this).attr("data-attributes"));
            var postData={
                table: attrs["data-table"],
            };
            for(var key in attrs )
                if( key.indexOf("where") > -1)
                    postData[key]=attrs[key];
                    
            $.ajax({
                url: "scripts/connection.php?truncate.php",
                type: "POST",
                data: postData,
                success: function(response){
                    parent.find("[data-type='deleteable']").addBack("[data-type='deleteable']").remove();
                }
            });
            
        });
    });
    
});

function confirmDeletion(elem, container){
    if($deleteObject===undefined || !$deleteObject.is(elem)){
        var clone=container.clone();
        clone.find("[data-type]").each(function(){
            var type=$(this).attr("data-type");
            if(type == "edit" || type == "save" || type == "delete")
                $(this).remove();
            if(type == "")
                if( $(this).hasClass("edit") || $(this).hasClass("save") || $(this).hasClass("delete") )
                    $(this).remove();
            $(this).attr("data-type", "");
        });
        
        $('#confirmDeletionModal').find('[data-id="content"]').html(clone);
        $('#confirmDeletionModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true,
        });
        $deleteObject=elem;
        return false;
    }
        $deleteObject=undefined;
    return true;
}