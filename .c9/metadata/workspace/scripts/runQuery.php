{"filter":false,"title":"runQuery.php","tooltip":"/scripts/runQuery.php","undoManager":{"mark":26,"position":26,"stack":[[{"start":{"row":1,"column":4},"end":{"row":2,"column":39},"action":"remove","lines":["session_start();","    include_once(\"sql_connection.php\");"],"id":48},{"start":{"row":1,"column":4},"end":{"row":5,"column":64},"action":"insert","lines":["","    session_start();","    //MySQLi Object-Oriented","    $conn=new mysqli(\"localhost\", \"david_gracias\", \"\", \"florida\");","    if(mysqli_connect_errno()){echo mysqli_connect_error; exit;}"]}],[{"start":{"row":1,"column":0},"end":{"row":2,"column":0},"action":"remove","lines":["    ",""],"id":49}],[{"start":{"row":4,"column":64},"end":{"row":5,"column":0},"action":"insert","lines":["",""],"id":50},{"start":{"row":5,"column":0},"end":{"row":5,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":6,"column":17},"end":{"row":6,"column":27},"action":"insert","lines":["key($_GET)"],"id":52}],[{"start":{"row":6,"column":27},"end":{"row":6,"column":39},"action":"remove","lines":["$_GET[\"url\"]"],"id":53}],[{"start":{"row":6,"column":17},"end":{"row":6,"column":18},"action":"insert","lines":[" "],"id":59}],[{"start":{"row":6,"column":28},"end":{"row":6,"column":29},"action":"insert","lines":[" "],"id":60}],[{"start":{"row":5,"column":4},"end":{"row":15,"column":1},"action":"insert","lines":["function str_lreplace($search, $replace, $subject)","{","    $pos = strrpos($subject, $search);","","    if($pos !== false)","    {","        $subject = substr_replace($subject, $replace, $pos, strlen($search));","    }","","    return $subject;","}"],"id":61}],[{"start":{"row":5,"column":0},"end":{"row":6,"column":0},"action":"remove","lines":["    function str_lreplace($search, $replace, $subject)",""],"id":62}],[{"start":{"row":5,"column":0},"end":{"row":6,"column":0},"action":"remove","lines":["{",""],"id":63}],[{"start":{"row":13,"column":0},"end":{"row":14,"column":0},"action":"remove","lines":["}",""],"id":64}],[{"start":{"row":5,"column":19},"end":{"row":5,"column":27},"action":"remove","lines":["$subject"],"id":65},{"start":{"row":5,"column":19},"end":{"row":5,"column":29},"action":"insert","lines":["key($_GET)"]}],[{"start":{"row":5,"column":31},"end":{"row":5,"column":38},"action":"remove","lines":["$search"],"id":66},{"start":{"row":5,"column":31},"end":{"row":5,"column":32},"action":"insert","lines":["\""]},{"start":{"row":5,"column":32},"end":{"row":5,"column":33},"action":"insert","lines":["_"]},{"start":{"row":5,"column":33},"end":{"row":5,"column":34},"action":"insert","lines":["\""]}],[{"start":{"row":7,"column":0},"end":{"row":8,"column":0},"action":"remove","lines":["    if($pos !== false)",""],"id":67}],[{"start":{"row":7,"column":0},"end":{"row":8,"column":0},"action":"remove","lines":["    {",""],"id":68}],[{"start":{"row":8,"column":0},"end":{"row":9,"column":0},"action":"remove","lines":["    }",""],"id":69}],[{"start":{"row":7,"column":0},"end":{"row":7,"column":19},"action":"remove","lines":["        $subject = "],"id":70}],[{"start":{"row":7,"column":15},"end":{"row":7,"column":23},"action":"remove","lines":["$subject"],"id":71},{"start":{"row":7,"column":15},"end":{"row":7,"column":25},"action":"insert","lines":["key($_GET)"]}],[{"start":{"row":7,"column":27},"end":{"row":7,"column":35},"action":"remove","lines":["$replace"],"id":72},{"start":{"row":7,"column":27},"end":{"row":7,"column":28},"action":"insert","lines":["\""]},{"start":{"row":7,"column":28},"end":{"row":7,"column":29},"action":"insert","lines":["."]},{"start":{"row":7,"column":29},"end":{"row":7,"column":30},"action":"insert","lines":["\""]}],[{"start":{"row":7,"column":45},"end":{"row":7,"column":52},"action":"remove","lines":["$search"],"id":73},{"start":{"row":7,"column":45},"end":{"row":7,"column":55},"action":"insert","lines":["key($_GET)"]}],[{"start":{"row":5,"column":11},"end":{"row":5,"column":35},"action":"remove","lines":["strrpos(key($_GET), \"_\")"],"id":74}],[{"start":{"row":5,"column":0},"end":{"row":6,"column":0},"action":"remove","lines":["    $pos = ;",""],"id":75}],[{"start":{"row":5,"column":0},"end":{"row":6,"column":0},"action":"remove","lines":["",""],"id":76}],[{"start":{"row":5,"column":32},"end":{"row":5,"column":36},"action":"remove","lines":["$pos"],"id":77},{"start":{"row":5,"column":32},"end":{"row":5,"column":56},"action":"insert","lines":["strrpos(key($_GET), \"_\")"]}],[{"start":{"row":5,"column":0},"end":{"row":5,"column":78},"action":"remove","lines":["substr_replace(key($_GET), \".\", strrpos(key($_GET), \"_\"), strlen(key($_GET)));"],"id":78}],[{"start":{"row":8,"column":18},"end":{"row":8,"column":28},"action":"remove","lines":["key($_GET)"],"id":79},{"start":{"row":8,"column":18},"end":{"row":8,"column":96},"action":"insert","lines":["substr_replace(key($_GET), \".\", strrpos(key($_GET), \"_\"), strlen(key($_GET)));"]}],[{"start":{"row":8,"column":95},"end":{"row":8,"column":96},"action":"remove","lines":[";"],"id":80}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":8,"column":95},"end":{"row":8,"column":95},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":41,"mode":"ace/mode/php"}},"timestamp":1551814540133,"hash":"83c93c29acef689ce0c727e79f6d31931328ffe0"}