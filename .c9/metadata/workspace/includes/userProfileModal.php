{"changed":true,"filter":false,"title":"userProfileModal.php","tooltip":"/includes/userProfileModal.php","value":"<div class=\"modal display-block\" id=\"newStudentModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"newStudentModal\" aria-hidden=\"true\">\n    <div class=\"modal-dialog\" role=\"document\">\n        <div class=\"modal-content\">\n            <div class=\"modal-header\">\n                <button type=\"button\" class=\"btn btn-danger float-right fa fa-close\" data-dismiss=\"modal\" onclick=\"$(this).parent().parent().parent().parent().removeClass('display-block');\"></button>\n                <h4 class=\"modal-title\" id=\"newStudentModal\">General Information</h4>\n            </div>\n            <div class=\"modal-body\">\n                <!-- students -- grad year, middle name (optional), student id, alt email addresses (personal or parent) -->\n                <?php if (true): \n                \n                //(new Date().getFullYear() )\n                ?>\n                    <span class=\"fa fa-id-card-o fa-lg\"></span>\n                    <h4 class = \"inline\">Student</h4>\n                    </br></br>\n                    <form id = \"general-student\">\n                        <div class = \"form-group\">\n                            <label for = \"middle-student\">Middle Name <span class=\"fa fa-asterisk color-red\"></span></label>\n                            <input class = \"form-control input\" required = \"required\" type = \"text\" placeholder = \"Middle\" />\n                        </div>\n                        <div class = \"form-group\">\n                            <label for = \"middle-student\">Middle Name <span class=\"fa fa-asterisk color-red\"></span></label>\n                            <input class = \"form-control input\" required = \"required\" type = \"text\" placeholder = \"Middle\" />\n                        </div>\n                    </form>\n                <?php endif; ?>\n                <!-- teachers -- are you a class sponsor? what is your graduating class? classroom? middle name? -->\n            </div>\n            <div class=\"modal-footer\">\n              <button type=\"button\" class=\"btn btn-primary\">Submit</button>\n            </div>\n        </div>\n    </div>\n</div>\n\n<script>\n\n\n\n</script>","undoManager":{"mark":4,"position":9,"stack":[[{"start":{"row":9,"column":33},"end":{"row":10,"column":0},"action":"insert","lines":["",""],"id":333},{"start":{"row":10,"column":0},"end":{"row":10,"column":16},"action":"insert","lines":["                "]},{"start":{"row":10,"column":16},"end":{"row":11,"column":0},"action":"insert","lines":["",""]},{"start":{"row":11,"column":0},"end":{"row":11,"column":16},"action":"insert","lines":["                "]},{"start":{"row":11,"column":16},"end":{"row":12,"column":0},"action":"insert","lines":["",""]},{"start":{"row":12,"column":0},"end":{"row":12,"column":16},"action":"insert","lines":["                "]}],[{"start":{"row":11,"column":16},"end":{"row":11,"column":45},"action":"insert","lines":["(new Date().getFullYear()-2 )"],"id":334}],[{"start":{"row":11,"column":43},"end":{"row":11,"column":44},"action":"insert","lines":["]"],"id":335}],[{"start":{"row":11,"column":43},"end":{"row":11,"column":44},"action":"remove","lines":["]"],"id":336},{"start":{"row":11,"column":42},"end":{"row":11,"column":43},"action":"remove","lines":["2"]},{"start":{"row":11,"column":41},"end":{"row":11,"column":42},"action":"remove","lines":["-"]}],[{"start":{"row":11,"column":16},"end":{"row":11,"column":17},"action":"insert","lines":["/"],"id":340},{"start":{"row":11,"column":17},"end":{"row":11,"column":18},"action":"insert","lines":["/"]}],[{"start":{"row":20,"column":30},"end":{"row":21,"column":25},"action":"insert","lines":["","                        <"],"id":341,"ignore":true}],[{"start":{"row":21,"column":25},"end":{"row":21,"column":28},"action":"insert","lines":["div"],"id":342,"ignore":true}],[{"start":{"row":21,"column":25},"end":{"row":21,"column":28},"action":"remove","lines":["div"],"id":343,"ignore":true}],[{"start":{"row":21,"column":24},"end":{"row":21,"column":25},"action":"remove","lines":["<"],"id":344,"ignore":true}],[{"start":{"row":21,"column":24},"end":{"row":24,"column":30},"action":"insert","lines":["<div class = \"form-group\">","                            <label for = \"middle-student\">Middle Name <span class=\"fa fa-asterisk color-red\"></span></label>","                            <input class = \"form-control input\" required = \"required\" type = \"text\" placeholder = \"Middle\" />","                        </div>"],"id":345,"ignore":true}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":18,"column":9},"end":{"row":18,"column":9},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":75,"mode":"ace/mode/php"}},"timestamp":1552586117774}