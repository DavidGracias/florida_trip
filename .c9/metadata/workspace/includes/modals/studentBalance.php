{"filter":false,"title":"studentBalance.php","tooltip":"/includes/modals/studentBalance.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":35,"column":38},"end":{"row":36,"column":0},"action":"insert","lines":["",""],"id":1279},{"start":{"row":36,"column":0},"end":{"row":36,"column":15},"action":"insert","lines":["               "]}],[{"start":{"row":36,"column":15},"end":{"row":42,"column":21},"action":"insert","lines":["var row = response.split(\"ENDOFROW\");","                    var cols = row[0].split(\"\\n\");","                    for(var y = 0; y < cols.length; y++){ //each column","                        var dict=cols[y].split(\":::\"); //array of length 2","                        if(dict[0] == \"balance\")","                            var balance = dict[1];","                    }"],"id":1280}],[{"start":{"row":42,"column":16},"end":{"row":42,"column":20},"action":"remove","lines":["    "],"id":1281}],[{"start":{"row":37,"column":16},"end":{"row":37,"column":20},"action":"remove","lines":["    "],"id":1282},{"start":{"row":37,"column":12},"end":{"row":37,"column":16},"action":"remove","lines":["    "]}],[{"start":{"row":37,"column":12},"end":{"row":37,"column":13},"action":"insert","lines":[" "],"id":1283},{"start":{"row":37,"column":13},"end":{"row":37,"column":14},"action":"insert","lines":[" "]},{"start":{"row":37,"column":14},"end":{"row":37,"column":15},"action":"insert","lines":[" "]}],[{"start":{"row":37,"column":14},"end":{"row":37,"column":15},"action":"remove","lines":[" "],"id":1284},{"start":{"row":37,"column":13},"end":{"row":37,"column":14},"action":"remove","lines":[" "]}],[{"start":{"row":37,"column":13},"end":{"row":37,"column":14},"action":"insert","lines":[" "],"id":1285},{"start":{"row":37,"column":14},"end":{"row":37,"column":15},"action":"insert","lines":[" "]}],[{"start":{"row":37,"column":15},"end":{"row":37,"column":16},"action":"insert","lines":[" "],"id":1286}],[{"start":{"row":37,"column":16},"end":{"row":37,"column":20},"action":"insert","lines":["    "],"id":1287}],[{"start":{"row":40,"column":39},"end":{"row":40,"column":46},"action":"remove","lines":["balance"],"id":1288}],[{"start":{"row":40,"column":39},"end":{"row":40,"column":40},"action":"insert","lines":["f"],"id":1289},{"start":{"row":40,"column":40},"end":{"row":40,"column":41},"action":"insert","lines":["N"]},{"start":{"row":40,"column":41},"end":{"row":40,"column":42},"action":"insert","lines":["a"]},{"start":{"row":40,"column":42},"end":{"row":40,"column":43},"action":"insert","lines":["m"]},{"start":{"row":40,"column":43},"end":{"row":40,"column":44},"action":"insert","lines":["e"]}],[{"start":{"row":41,"column":32},"end":{"row":41,"column":39},"action":"remove","lines":["balance"],"id":1290}],[{"start":{"row":41,"column":32},"end":{"row":41,"column":33},"action":"insert","lines":["f"],"id":1291},{"start":{"row":41,"column":33},"end":{"row":41,"column":34},"action":"insert","lines":["N"]},{"start":{"row":41,"column":34},"end":{"row":41,"column":35},"action":"insert","lines":["a"]},{"start":{"row":41,"column":35},"end":{"row":41,"column":36},"action":"insert","lines":["m"]},{"start":{"row":41,"column":36},"end":{"row":41,"column":37},"action":"insert","lines":["e"]}],[{"start":{"row":41,"column":31},"end":{"row":41,"column":32},"action":"remove","lines":[" "],"id":1292},{"start":{"row":41,"column":30},"end":{"row":41,"column":31},"action":"remove","lines":["r"]},{"start":{"row":41,"column":29},"end":{"row":41,"column":30},"action":"remove","lines":["a"]},{"start":{"row":41,"column":28},"end":{"row":41,"column":29},"action":"remove","lines":["v"]}],[{"start":{"row":41,"column":28},"end":{"row":41,"column":29},"action":"insert","lines":["$"],"id":1293}],[{"start":{"row":41,"column":45},"end":{"row":42,"column":0},"action":"insert","lines":["",""],"id":1294},{"start":{"row":42,"column":0},"end":{"row":42,"column":28},"action":"insert","lines":["                            "]}],[{"start":{"row":42,"column":24},"end":{"row":42,"column":28},"action":"remove","lines":["    "],"id":1295}],[{"start":{"row":42,"column":24},"end":{"row":43,"column":45},"action":"insert","lines":["if(dict[0] == \"fName\")","                            $fName = dict[1];"],"id":1296}],[{"start":{"row":42,"column":39},"end":{"row":42,"column":44},"action":"remove","lines":["fName"],"id":1297}],[{"start":{"row":42,"column":39},"end":{"row":42,"column":40},"action":"insert","lines":[";"],"id":1298}],[{"start":{"row":42,"column":39},"end":{"row":42,"column":40},"action":"remove","lines":[";"],"id":1299}],[{"start":{"row":42,"column":39},"end":{"row":42,"column":40},"action":"insert","lines":["l"],"id":1300},{"start":{"row":42,"column":40},"end":{"row":42,"column":41},"action":"insert","lines":["N"]},{"start":{"row":42,"column":41},"end":{"row":42,"column":42},"action":"insert","lines":["a"]},{"start":{"row":42,"column":42},"end":{"row":42,"column":43},"action":"insert","lines":["m"]},{"start":{"row":42,"column":43},"end":{"row":42,"column":44},"action":"insert","lines":["e"]}],[{"start":{"row":43,"column":28},"end":{"row":43,"column":34},"action":"remove","lines":["$fName"],"id":1301}],[{"start":{"row":43,"column":28},"end":{"row":43,"column":29},"action":"insert","lines":["$"],"id":1302},{"start":{"row":43,"column":29},"end":{"row":43,"column":30},"action":"insert","lines":["l"]},{"start":{"row":43,"column":30},"end":{"row":43,"column":31},"action":"insert","lines":["a"]},{"start":{"row":43,"column":31},"end":{"row":43,"column":32},"action":"insert","lines":["n"]}],[{"start":{"row":43,"column":31},"end":{"row":43,"column":32},"action":"remove","lines":["n"],"id":1303},{"start":{"row":43,"column":30},"end":{"row":43,"column":31},"action":"remove","lines":["a"]}],[{"start":{"row":43,"column":30},"end":{"row":43,"column":31},"action":"insert","lines":["N"],"id":1304},{"start":{"row":43,"column":31},"end":{"row":43,"column":32},"action":"insert","lines":["a"]},{"start":{"row":43,"column":32},"end":{"row":43,"column":33},"action":"insert","lines":["m"]},{"start":{"row":43,"column":33},"end":{"row":43,"column":34},"action":"insert","lines":["e"]}],[{"start":{"row":43,"column":45},"end":{"row":44,"column":0},"action":"insert","lines":["",""],"id":1305},{"start":{"row":44,"column":0},"end":{"row":44,"column":28},"action":"insert","lines":["                            "]}],[{"start":{"row":44,"column":24},"end":{"row":44,"column":28},"action":"remove","lines":["    "],"id":1306}],[{"start":{"row":44,"column":24},"end":{"row":45,"column":45},"action":"insert","lines":["if(dict[0] == \"fName\")","                            $fName = dict[1];"],"id":1307}],[{"start":{"row":44,"column":39},"end":{"row":44,"column":44},"action":"remove","lines":["fName"],"id":1308}],[{"start":{"row":44,"column":39},"end":{"row":44,"column":40},"action":"insert","lines":["b"],"id":1309},{"start":{"row":44,"column":40},"end":{"row":44,"column":41},"action":"insert","lines":["a"]},{"start":{"row":44,"column":41},"end":{"row":44,"column":42},"action":"insert","lines":["l"]},{"start":{"row":44,"column":42},"end":{"row":44,"column":43},"action":"insert","lines":["a"]},{"start":{"row":44,"column":43},"end":{"row":44,"column":44},"action":"insert","lines":["n"]},{"start":{"row":44,"column":44},"end":{"row":44,"column":45},"action":"insert","lines":["c"]},{"start":{"row":44,"column":45},"end":{"row":44,"column":46},"action":"insert","lines":["e"]}],[{"start":{"row":45,"column":28},"end":{"row":45,"column":34},"action":"remove","lines":["$fName"],"id":1310}],[{"start":{"row":45,"column":28},"end":{"row":45,"column":29},"action":"insert","lines":["$"],"id":1311},{"start":{"row":45,"column":29},"end":{"row":45,"column":30},"action":"insert","lines":["b"]},{"start":{"row":45,"column":30},"end":{"row":45,"column":31},"action":"insert","lines":["a"]},{"start":{"row":45,"column":31},"end":{"row":45,"column":32},"action":"insert","lines":["l"]},{"start":{"row":45,"column":32},"end":{"row":45,"column":33},"action":"insert","lines":["a"]},{"start":{"row":45,"column":33},"end":{"row":45,"column":34},"action":"insert","lines":["n"]},{"start":{"row":45,"column":34},"end":{"row":45,"column":35},"action":"insert","lines":["c"]},{"start":{"row":45,"column":35},"end":{"row":45,"column":36},"action":"insert","lines":["e"]}],[{"start":{"row":37,"column":16},"end":{"row":37,"column":20},"action":"remove","lines":["    "],"id":1312}],[{"start":{"row":38,"column":16},"end":{"row":38,"column":20},"action":"remove","lines":["    "],"id":1313}],[{"start":{"row":39,"column":20},"end":{"row":39,"column":24},"action":"remove","lines":["    "],"id":1314}],[{"start":{"row":40,"column":22},"end":{"row":40,"column":23},"action":"remove","lines":[" "],"id":1315}],[{"start":{"row":40,"column":22},"end":{"row":40,"column":23},"action":"insert","lines":[" "],"id":1316}],[{"start":{"row":40,"column":20},"end":{"row":40,"column":24},"action":"remove","lines":["    "],"id":1317}],[{"start":{"row":41,"column":24},"end":{"row":41,"column":28},"action":"remove","lines":["    "],"id":1318}],[{"start":{"row":42,"column":20},"end":{"row":42,"column":24},"action":"remove","lines":["    "],"id":1319}],[{"start":{"row":43,"column":24},"end":{"row":43,"column":28},"action":"remove","lines":["    "],"id":1320}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":24},"action":"remove","lines":["    "],"id":1321}],[{"start":{"row":45,"column":24},"end":{"row":45,"column":28},"action":"remove","lines":["    "],"id":1322}],[{"start":{"row":36,"column":15},"end":{"row":36,"column":16},"action":"insert","lines":[" "],"id":1323}],[{"start":{"row":46,"column":17},"end":{"row":47,"column":0},"action":"insert","lines":["",""],"id":1324},{"start":{"row":47,"column":0},"end":{"row":47,"column":16},"action":"insert","lines":["                "]}],[{"start":{"row":47,"column":16},"end":{"row":47,"column":17},"action":"insert","lines":["$"],"id":1325}],[{"start":{"row":47,"column":17},"end":{"row":47,"column":19},"action":"insert","lines":["()"],"id":1326}],[{"start":{"row":47,"column":18},"end":{"row":47,"column":20},"action":"insert","lines":["\"\""],"id":1327}],[{"start":{"row":47,"column":19},"end":{"row":47,"column":20},"action":"insert","lines":["$"],"id":1328},{"start":{"row":47,"column":20},"end":{"row":47,"column":21},"action":"insert","lines":["s"]},{"start":{"row":47,"column":21},"end":{"row":47,"column":22},"action":"insert","lines":["t"]},{"start":{"row":47,"column":22},"end":{"row":47,"column":23},"action":"insert","lines":["u"]},{"start":{"row":47,"column":23},"end":{"row":47,"column":24},"action":"insert","lines":["d"]},{"start":{"row":47,"column":24},"end":{"row":47,"column":25},"action":"insert","lines":["e"]},{"start":{"row":47,"column":25},"end":{"row":47,"column":26},"action":"insert","lines":["n"]},{"start":{"row":47,"column":26},"end":{"row":47,"column":27},"action":"insert","lines":["t"]}],[{"start":{"row":47,"column":26},"end":{"row":47,"column":27},"action":"remove","lines":["t"],"id":1329},{"start":{"row":47,"column":25},"end":{"row":47,"column":26},"action":"remove","lines":["n"]},{"start":{"row":47,"column":24},"end":{"row":47,"column":25},"action":"remove","lines":["e"]},{"start":{"row":47,"column":23},"end":{"row":47,"column":24},"action":"remove","lines":["d"]},{"start":{"row":47,"column":22},"end":{"row":47,"column":23},"action":"remove","lines":["u"]},{"start":{"row":47,"column":21},"end":{"row":47,"column":22},"action":"remove","lines":["t"]},{"start":{"row":47,"column":20},"end":{"row":47,"column":21},"action":"remove","lines":["s"]},{"start":{"row":47,"column":19},"end":{"row":47,"column":20},"action":"remove","lines":["$"]}],[{"start":{"row":47,"column":19},"end":{"row":47,"column":20},"action":"insert","lines":["#"],"id":1330},{"start":{"row":47,"column":20},"end":{"row":47,"column":21},"action":"insert","lines":["s"]},{"start":{"row":47,"column":21},"end":{"row":47,"column":22},"action":"insert","lines":["t"]},{"start":{"row":47,"column":22},"end":{"row":47,"column":23},"action":"insert","lines":["u"]},{"start":{"row":47,"column":23},"end":{"row":47,"column":24},"action":"insert","lines":["d"]},{"start":{"row":47,"column":24},"end":{"row":47,"column":25},"action":"insert","lines":["e"]},{"start":{"row":47,"column":25},"end":{"row":47,"column":26},"action":"insert","lines":["n"]},{"start":{"row":47,"column":26},"end":{"row":47,"column":27},"action":"insert","lines":["t"]}],[{"start":{"row":47,"column":27},"end":{"row":47,"column":28},"action":"insert","lines":[" "],"id":1331}],[{"start":{"row":47,"column":27},"end":{"row":47,"column":28},"action":"remove","lines":[" "],"id":1332}],[{"start":{"row":47,"column":27},"end":{"row":47,"column":28},"action":"insert","lines":["B"],"id":1333},{"start":{"row":47,"column":28},"end":{"row":47,"column":29},"action":"insert","lines":["a"]},{"start":{"row":47,"column":29},"end":{"row":47,"column":30},"action":"insert","lines":["l"]},{"start":{"row":47,"column":30},"end":{"row":47,"column":31},"action":"insert","lines":["a"]},{"start":{"row":47,"column":31},"end":{"row":47,"column":32},"action":"insert","lines":["n"]},{"start":{"row":47,"column":32},"end":{"row":47,"column":33},"action":"insert","lines":["c"]},{"start":{"row":47,"column":33},"end":{"row":47,"column":34},"action":"insert","lines":["e"]}],[{"start":{"row":47,"column":34},"end":{"row":47,"column":35},"action":"insert","lines":[" "],"id":1334},{"start":{"row":47,"column":35},"end":{"row":47,"column":36},"action":"insert","lines":["."]}],[{"start":{"row":47,"column":36},"end":{"row":47,"column":37},"action":"insert","lines":["m"],"id":1335},{"start":{"row":47,"column":37},"end":{"row":47,"column":38},"action":"insert","lines":["o"]},{"start":{"row":47,"column":38},"end":{"row":47,"column":39},"action":"insert","lines":["d"]},{"start":{"row":47,"column":39},"end":{"row":47,"column":40},"action":"insert","lines":["a"]},{"start":{"row":47,"column":40},"end":{"row":47,"column":41},"action":"insert","lines":["l"]},{"start":{"row":47,"column":41},"end":{"row":47,"column":42},"action":"insert","lines":["-"]},{"start":{"row":47,"column":42},"end":{"row":47,"column":43},"action":"insert","lines":["t"]},{"start":{"row":47,"column":43},"end":{"row":47,"column":44},"action":"insert","lines":["i"]},{"start":{"row":47,"column":44},"end":{"row":47,"column":45},"action":"insert","lines":["t"]},{"start":{"row":47,"column":45},"end":{"row":47,"column":46},"action":"insert","lines":["l"]},{"start":{"row":47,"column":46},"end":{"row":47,"column":47},"action":"insert","lines":["e"]}],[{"start":{"row":47,"column":49},"end":{"row":47,"column":50},"action":"insert","lines":["."],"id":1336}],[{"start":{"row":47,"column":50},"end":{"row":47,"column":51},"action":"insert","lines":["t"],"id":1337},{"start":{"row":47,"column":51},"end":{"row":47,"column":52},"action":"insert","lines":["e"]},{"start":{"row":47,"column":52},"end":{"row":47,"column":53},"action":"insert","lines":["x"]},{"start":{"row":47,"column":53},"end":{"row":47,"column":54},"action":"insert","lines":["t"]}],[{"start":{"row":47,"column":54},"end":{"row":47,"column":56},"action":"insert","lines":["()"],"id":1338}],[{"start":{"row":47,"column":55},"end":{"row":47,"column":57},"action":"insert","lines":["\"\""],"id":1339}],[{"start":{"row":47,"column":55},"end":{"row":47,"column":57},"action":"remove","lines":["\"\""],"id":1340}],[{"start":{"row":47,"column":55},"end":{"row":47,"column":56},"action":"insert","lines":["$"],"id":1341},{"start":{"row":47,"column":56},"end":{"row":47,"column":57},"action":"insert","lines":["f"]},{"start":{"row":47,"column":57},"end":{"row":47,"column":58},"action":"insert","lines":["N"]},{"start":{"row":47,"column":58},"end":{"row":47,"column":59},"action":"insert","lines":["a"]},{"start":{"row":47,"column":59},"end":{"row":47,"column":60},"action":"insert","lines":["m"]},{"start":{"row":47,"column":60},"end":{"row":47,"column":61},"action":"insert","lines":["e"]},{"start":{"row":47,"column":61},"end":{"row":47,"column":62},"action":"insert","lines":["+"]}],[{"start":{"row":47,"column":62},"end":{"row":47,"column":64},"action":"insert","lines":["\"\""],"id":1342}],[{"start":{"row":47,"column":63},"end":{"row":47,"column":64},"action":"insert","lines":[" "],"id":1343}],[{"start":{"row":47,"column":65},"end":{"row":47,"column":66},"action":"insert","lines":["+"],"id":1344},{"start":{"row":47,"column":66},"end":{"row":47,"column":67},"action":"insert","lines":["$"]},{"start":{"row":47,"column":67},"end":{"row":47,"column":68},"action":"insert","lines":["l"]}],[{"start":{"row":47,"column":68},"end":{"row":47,"column":69},"action":"insert","lines":["N"],"id":1345},{"start":{"row":47,"column":69},"end":{"row":47,"column":70},"action":"insert","lines":["a"]},{"start":{"row":47,"column":70},"end":{"row":47,"column":71},"action":"insert","lines":["m"]},{"start":{"row":47,"column":71},"end":{"row":47,"column":72},"action":"insert","lines":["e"]}],[{"start":{"row":47,"column":72},"end":{"row":47,"column":73},"action":"insert","lines":["+"],"id":1346}],[{"start":{"row":47,"column":73},"end":{"row":47,"column":75},"action":"insert","lines":["\"\""],"id":1347}],[{"start":{"row":47,"column":74},"end":{"row":47,"column":75},"action":"insert","lines":["("],"id":1348}],[{"start":{"row":47,"column":76},"end":{"row":47,"column":77},"action":"insert","lines":["+"],"id":1349},{"start":{"row":47,"column":77},"end":{"row":47,"column":78},"action":"insert","lines":["$"]},{"start":{"row":47,"column":78},"end":{"row":47,"column":79},"action":"insert","lines":["b"]},{"start":{"row":47,"column":79},"end":{"row":47,"column":80},"action":"insert","lines":["a"]},{"start":{"row":47,"column":80},"end":{"row":47,"column":81},"action":"insert","lines":["l"]},{"start":{"row":47,"column":81},"end":{"row":47,"column":82},"action":"insert","lines":["a"]}],[{"start":{"row":47,"column":82},"end":{"row":47,"column":83},"action":"insert","lines":["n"],"id":1350},{"start":{"row":47,"column":83},"end":{"row":47,"column":84},"action":"insert","lines":["c"]},{"start":{"row":47,"column":84},"end":{"row":47,"column":85},"action":"insert","lines":["e"]},{"start":{"row":47,"column":85},"end":{"row":47,"column":86},"action":"insert","lines":["+"]}],[{"start":{"row":47,"column":86},"end":{"row":47,"column":88},"action":"insert","lines":["\"\""],"id":1351}],[{"start":{"row":47,"column":87},"end":{"row":47,"column":88},"action":"insert","lines":[")"],"id":1352}],[{"start":{"row":47,"column":90},"end":{"row":47,"column":91},"action":"insert","lines":[";"],"id":1353}],[{"start":{"row":47,"column":74},"end":{"row":47,"column":75},"action":"insert","lines":[" "],"id":1354}],[{"start":{"row":47,"column":76},"end":{"row":47,"column":77},"action":"insert","lines":["$"],"id":1375}],[{"start":{"row":12,"column":35},"end":{"row":12,"column":36},"action":"insert","lines":[" "],"id":1376},{"start":{"row":12,"column":36},"end":{"row":12,"column":37},"action":"insert","lines":["t"]},{"start":{"row":12,"column":37},"end":{"row":12,"column":38},"action":"insert","lines":["a"]},{"start":{"row":12,"column":38},"end":{"row":12,"column":39},"action":"insert","lines":["v"]},{"start":{"row":12,"column":39},"end":{"row":12,"column":40},"action":"insert","lines":["k"]},{"start":{"row":12,"column":40},"end":{"row":12,"column":41},"action":"insert","lines":["="]},{"start":{"row":12,"column":40},"end":{"row":12,"column":41},"action":"remove","lines":["="]},{"start":{"row":12,"column":39},"end":{"row":12,"column":40},"action":"remove","lines":["k"]},{"start":{"row":12,"column":38},"end":{"row":12,"column":39},"action":"remove","lines":["v"]}],[{"start":{"row":12,"column":38},"end":{"row":12,"column":39},"action":"insert","lines":["b"],"id":1377},{"start":{"row":12,"column":39},"end":{"row":12,"column":40},"action":"insert","lines":["v"]}],[{"start":{"row":12,"column":39},"end":{"row":12,"column":40},"action":"remove","lines":["v"],"id":1378}],[{"start":{"row":12,"column":39},"end":{"row":12,"column":40},"action":"insert","lines":["l"],"id":1379},{"start":{"row":12,"column":40},"end":{"row":12,"column":41},"action":"insert","lines":["e"]},{"start":{"row":12,"column":41},"end":{"row":12,"column":42},"action":"insert","lines":["-"]},{"start":{"row":12,"column":42},"end":{"row":12,"column":43},"action":"insert","lines":["s"]},{"start":{"row":12,"column":43},"end":{"row":12,"column":44},"action":"insert","lines":["t"]},{"start":{"row":12,"column":44},"end":{"row":12,"column":45},"action":"insert","lines":["r"]},{"start":{"row":12,"column":45},"end":{"row":12,"column":46},"action":"insert","lines":["i"]},{"start":{"row":12,"column":46},"end":{"row":12,"column":47},"action":"insert","lines":["p"]},{"start":{"row":12,"column":47},"end":{"row":12,"column":48},"action":"insert","lines":["e"]},{"start":{"row":12,"column":48},"end":{"row":12,"column":49},"action":"insert","lines":["d"]}],[{"start":{"row":59,"column":39},"end":{"row":60,"column":0},"action":"insert","lines":["",""],"id":1380},{"start":{"row":60,"column":0},"end":{"row":60,"column":16},"action":"insert","lines":["                "]}],[{"start":{"row":60,"column":16},"end":{"row":60,"column":17},"action":"insert","lines":["$"],"id":1381}],[{"start":{"row":60,"column":17},"end":{"row":60,"column":19},"action":"insert","lines":["()"],"id":1382}],[{"start":{"row":60,"column":18},"end":{"row":60,"column":20},"action":"insert","lines":["\"\""],"id":1383}],[{"start":{"row":60,"column":19},"end":{"row":60,"column":20},"action":"insert","lines":["#"],"id":1384},{"start":{"row":60,"column":20},"end":{"row":60,"column":21},"action":"insert","lines":["s"]},{"start":{"row":60,"column":21},"end":{"row":60,"column":22},"action":"insert","lines":["t"]},{"start":{"row":60,"column":22},"end":{"row":60,"column":23},"action":"insert","lines":["u"]},{"start":{"row":60,"column":23},"end":{"row":60,"column":24},"action":"insert","lines":["d"]}],[{"start":{"row":60,"column":24},"end":{"row":60,"column":25},"action":"insert","lines":["e"],"id":1385},{"start":{"row":60,"column":25},"end":{"row":60,"column":26},"action":"insert","lines":["n"]},{"start":{"row":60,"column":26},"end":{"row":60,"column":27},"action":"insert","lines":["t"]},{"start":{"row":60,"column":27},"end":{"row":60,"column":28},"action":"insert","lines":["B"]},{"start":{"row":60,"column":28},"end":{"row":60,"column":29},"action":"insert","lines":["a"]},{"start":{"row":60,"column":29},"end":{"row":60,"column":30},"action":"insert","lines":["l"]},{"start":{"row":60,"column":30},"end":{"row":60,"column":31},"action":"insert","lines":["a"]}],[{"start":{"row":60,"column":31},"end":{"row":60,"column":32},"action":"insert","lines":["n"],"id":1386},{"start":{"row":60,"column":32},"end":{"row":60,"column":33},"action":"insert","lines":["c"]},{"start":{"row":60,"column":33},"end":{"row":60,"column":34},"action":"insert","lines":["e"]},{"start":{"row":60,"column":34},"end":{"row":60,"column":35},"action":"insert","lines":["T"]},{"start":{"row":60,"column":35},"end":{"row":60,"column":36},"action":"insert","lines":["a"]},{"start":{"row":60,"column":36},"end":{"row":60,"column":37},"action":"insert","lines":["b"]},{"start":{"row":60,"column":37},"end":{"row":60,"column":38},"action":"insert","lines":["l"]},{"start":{"row":60,"column":38},"end":{"row":60,"column":39},"action":"insert","lines":["e"]}],[{"start":{"row":60,"column":39},"end":{"row":60,"column":40},"action":"insert","lines":[" "],"id":1387},{"start":{"row":60,"column":40},"end":{"row":60,"column":41},"action":"insert","lines":["f"]},{"start":{"row":60,"column":41},"end":{"row":60,"column":42},"action":"insert","lines":["d"]},{"start":{"row":60,"column":42},"end":{"row":60,"column":43},"action":"insert","lines":["="]},{"start":{"row":60,"column":43},"end":{"row":60,"column":44},"action":"insert","lines":["="]}],[{"start":{"row":60,"column":43},"end":{"row":60,"column":44},"action":"remove","lines":["="],"id":1388},{"start":{"row":60,"column":42},"end":{"row":60,"column":43},"action":"remove","lines":["="]},{"start":{"row":60,"column":41},"end":{"row":60,"column":42},"action":"remove","lines":["d"]},{"start":{"row":60,"column":40},"end":{"row":60,"column":41},"action":"remove","lines":["f"]}],[{"start":{"row":60,"column":40},"end":{"row":60,"column":41},"action":"insert","lines":["t"],"id":1389},{"start":{"row":60,"column":41},"end":{"row":60,"column":42},"action":"insert","lines":["d"]}],[{"start":{"row":60,"column":43},"end":{"row":60,"column":45},"action":"insert","lines":["()"],"id":1390}],[{"start":{"row":60,"column":44},"end":{"row":60,"column":45},"action":"insert","lines":["."],"id":1391},{"start":{"row":60,"column":45},"end":{"row":60,"column":46},"action":"insert","lines":["="]}],[{"start":{"row":60,"column":45},"end":{"row":60,"column":46},"action":"remove","lines":["="],"id":1392},{"start":{"row":60,"column":44},"end":{"row":60,"column":45},"action":"remove","lines":["."]},{"start":{"row":60,"column":43},"end":{"row":60,"column":45},"action":"remove","lines":["()"]}],[{"start":{"row":60,"column":44},"end":{"row":60,"column":45},"action":"insert","lines":["."],"id":1393},{"start":{"row":60,"column":45},"end":{"row":60,"column":46},"action":"insert","lines":["c"]},{"start":{"row":60,"column":46},"end":{"row":60,"column":47},"action":"insert","lines":["l"]},{"start":{"row":60,"column":47},"end":{"row":60,"column":48},"action":"insert","lines":["e"]},{"start":{"row":60,"column":48},"end":{"row":60,"column":49},"action":"insert","lines":["a"]},{"start":{"row":60,"column":49},"end":{"row":60,"column":50},"action":"insert","lines":["r"]},{"start":{"row":60,"column":50},"end":{"row":60,"column":51},"action":"insert","lines":[";"]}],[{"start":{"row":60,"column":50},"end":{"row":60,"column":51},"action":"remove","lines":[";"],"id":1394},{"start":{"row":60,"column":49},"end":{"row":60,"column":50},"action":"remove","lines":["r"]},{"start":{"row":60,"column":48},"end":{"row":60,"column":49},"action":"remove","lines":["a"]},{"start":{"row":60,"column":47},"end":{"row":60,"column":48},"action":"remove","lines":["e"]},{"start":{"row":60,"column":46},"end":{"row":60,"column":47},"action":"remove","lines":["l"]}],[{"start":{"row":60,"column":46},"end":{"row":60,"column":47},"action":"insert","lines":["r"],"id":1395},{"start":{"row":60,"column":47},"end":{"row":60,"column":48},"action":"insert","lines":["e"]}],[{"start":{"row":60,"column":47},"end":{"row":60,"column":48},"action":"remove","lines":["e"],"id":1396},{"start":{"row":60,"column":46},"end":{"row":60,"column":47},"action":"remove","lines":["r"]},{"start":{"row":60,"column":45},"end":{"row":60,"column":46},"action":"remove","lines":["c"]}],[{"start":{"row":60,"column":45},"end":{"row":60,"column":46},"action":"insert","lines":["r"],"id":1397},{"start":{"row":60,"column":46},"end":{"row":60,"column":47},"action":"insert","lines":["e"]},{"start":{"row":60,"column":47},"end":{"row":60,"column":48},"action":"insert","lines":["m"]},{"start":{"row":60,"column":48},"end":{"row":60,"column":49},"action":"insert","lines":["o"]},{"start":{"row":60,"column":49},"end":{"row":60,"column":50},"action":"insert","lines":["v"]},{"start":{"row":60,"column":50},"end":{"row":60,"column":51},"action":"insert","lines":["e"]}],[{"start":{"row":60,"column":51},"end":{"row":60,"column":53},"action":"insert","lines":["()"],"id":1398}],[{"start":{"row":60,"column":53},"end":{"row":60,"column":54},"action":"insert","lines":[";"],"id":1399}]]},"ace":{"folds":[],"scrolltop":1237.5,"scrollleft":0,"selection":{"start":{"row":62,"column":31},"end":{"row":62,"column":31},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1560345761749,"hash":"c869facca24700b0abdf0bf9d07f16822be7f0d7"}