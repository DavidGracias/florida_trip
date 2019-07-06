<script>
    var calendar = document.getElementById('cal-table');
    var gridTable = document.getElementById("table-body");

    var currentDate = new Date();
    var selectedDate = currentDate;
    var selectedDayBlock = null;
    var globalEventObj = {};
    var DateTimes = [];
    var isAllDay=[];
    var Events = document.getElementById('events');
    var fadeTimeout = null;

    function createCalendar(date, side) {
        currentDate = date;
        startDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

        let monthName = currentDate.toLocaleString("en-US", {
            month: "long"
        });
        let yearNum = currentDate.toLocaleString("en-US", {
            year: "numeric"
        });
        document.getElementById("month-name").innerHTML = `${monthName} ${yearNum}`;

        if (side == "left")
            gridTable.className = "animated fadeOutRight";
        else if (side == "right")
            gridTable.className = "animated fadeOutLeft";
        else if (side == "in")
            gridTable.className = "animated fadeOut";
        else
            gridTable.className = "animated";
        
        clearTimeout(fadeTimeout);
        fadeTimeout = setTimeout(() => {
            gridTable.innerHTML = "";

            let newTr = document.createElement("div");
            newTr.className = "Calrow";
            let currentTr = gridTable.appendChild(newTr);

            for (let i = 1; i <= startDate.getDay(); i++) {
                let emptyDivCol = document.createElement("div");
                emptyDivCol.className = "col empty-day";
                currentTr.appendChild(emptyDivCol);
            }

            var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            lastDay = lastDay.getDate();

            for (let i = 1; i <= lastDay; i++) {
                if (currentTr.children.length >= 7)
                    currentTr = gridTable.appendChild(addNewRow());
                    
                let currentDay = document.createElement("div");
                currentDay.className = "col";
                if ( selectedDayBlock == null && i == currentDate.getDate() ) {
                    selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);

                    document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
                        // month: "long",
                        day: "2-digit",
                        // weekday:"long",
                        // year: "numeric",
                    });
                    document.getElementById("weekDay").innerHTML=selectedDate.toLocaleString("en-US",{
                        weekday:"long",
                    });

                    selectedDayBlock = currentDay;
                    currentDay.classList.add("blue");
                    showEvents();
                }
                
                currentDay.innerHTML = i;

                //show marks
                if (globalEventObj[new Date(currentDate.getFullYear(), currentDate.getMonth(), i).toDateString()]) {
                    let eventMark = document.createElement("i");
                    eventMark.className = "day-mark fas fa-splotch fa-xs";
                    currentDay.prepend(eventMark);
                }

                currentTr.appendChild(currentDay);
            }


            for (let i = currentTr.getElementsByTagName("div").length; i < 7; i++) {
                let emptyDivCol = document.createElement("div");
                emptyDivCol.className = "col empty-day";
                currentTr.appendChild(emptyDivCol);
            }

        if (side == "left")
            gridTable.className = "animated fadeInLeft";
        else if (side == "right")
            gridTable.className = "animated fadeInRight";
        else if (side == "in")
            gridTable.className = "animated fadeIn";
        else
            gridTable.className = "animated";

            function addNewRow() {
                let node = document.createElement("div");
                node.className = "Calrow";
                return node;
            }

        }, !side ? 0 : 270);
    }
    createCalendar(currentDate, "in");

    var prevButton = document.getElementById("leftArrow");
    var nextButton = document.getElementById("rightArrow");
    var todayButton = document.getElementById("changeToToday");
    
    todayButton.onclick = function changeMonthToday(){
        let side;
        const today = new Date();
        var d1 = selectedDate.getFullYear() +""+ selectedDate.getMonth();
        var d2 = today.getFullYear() +""+ today.getMonth();
        if(Number(d1) < Number(d2))
            side = "right";
        else if(Number(d1) > Number(d2))
            side = "left";
        else if(selectedDate.getDate() == today.getDate())
            return showEvents();
        
            
        currentDate = today;
        selectedDate = currentDate;
        selectedDayBlock = null;
        createCalendar(currentDate, side);
        
    };
    prevButton.onclick = function changeMonthPrev() {
        currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);
        if(currentDate.getMonth() == new Date().getMonth())
            currentDate = new Date();
        selectedDate = currentDate;
        selectedDayBlock = null;
        createCalendar(currentDate, "left");
    }
    nextButton.onclick = function changeMonthNext() {
        currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);
        if(currentDate.getMonth() == new Date().getMonth())
            currentDate = new Date();
        selectedDate = currentDate;
        selectedDayBlock = null;
        createCalendar(currentDate, "right");
    }

    
    function addEvent(title, desc, date, allday) {
        selectedDate = date;
        if (!globalEventObj[selectedDate.toDateString()])
            globalEventObj[selectedDate.toDateString()] = {};
            
        globalEventObj[selectedDate.toDateString()][title] = desc;
        DateTimes[title] = date;
        isAllDay[title]=allday;
    }
    
    //Converts Military time to standard and returns a string
    function milToStan(Name,hours, minutes){
        var getMinutes=(minutes<10? '0':'')+minutes;
        var temp;
    if(Name==true){
        return "ALL DAY";
    }    
        if(hours>=0 && hours<12){
            temp=hours;
          if(hours==0){
                temp=12;
           }
           return ""+temp+":"+getMinutes+"AM";
           
        }
        else{
            temp=hours-12;
          if(hours==12){
              temp=12;
          }
          return ""+temp+":"+getMinutes+"PM";
        }
    }
  
    function showEvents() {
        const sidebarEvents = $("#sideEvents");
        const objWithDate = globalEventObj[selectedDate.toDateString()];
        
        let allDay = [];
        let events = [];
        
        sidebarEvents.html("");

    //saves information about each event that day into appropiate arrays
        const eventContainer = $("<div></div>").addClass("eventCard");
        const eventHeader = $("<div></div>").addClass("eventCard-header");
        const eventDescription = $("<div></div>").addClass("eventCard-description");
        
        if (objWithDate) {
            eventHeader.html("Schedule <i class='fa fa-clock'></i>");
            
            for (const key in globalEventObj[selectedDate.toDateString()]){
                if(isAllDay[key])
                    allDay.push({
                        name: key,
                        description: objWithDate[key],
                        date: "All Day",
                    });
                else
                    events.push({
                        name: key,
                        description: objWithDate[key],
                        date: new Date(DateTimes[key]),
                    });
            }
            allDay = allDay.sort(function(a, b){
                const x = a["name"]; const y = b["name"];
                return ((x < y) ? -1 : ((x > y) ? 1 : 0));
            });
            events = events.sort(function(a, b){
                const x = a["date"]; const y = b["date"];
                return ((x < y) ? -1 : ((x > y) ? 1 : 0));
            });
            events = allDay.concat(events);
            for(var i = 0; i < events.length; i++){
                var node = $("<div></div>");
                node.append("<span class='pill'>"+events[i].date+"</span> - ");
                node.append("<span class='bold'>"+events[i].name+"</span>");
                node.append("<div>"+events[i].description+"</div>");
                
                eventDescription.append(node);
            }
    //     if(startingdiv.offsetHeight>=panel.offsetHeight){
    //      var arrow=document.createElement("div");
    //       arrow.innerHTML="<span id='SM'>See More <br/> <i class='fa fa-chevron-down' onclick='slideUp()' id='slideArrow'></i> </span>";
    //       arrow.className="Click"
    //       getTimeline.appendChild(arrow)
    //  }
        }
        else {
            eventContainer.addClass("empty-message");
            eventHeader.html("There are no events on this day!");
            eventDescription.html("");
        }
        
        
        eventContainer.append(eventHeader);
        eventContainer.append(eventDescription);
        sidebarEvents.append(eventContainer);


    }


    gridTable.onclick = function(e) {
        let target = e.target;
        if(e.target.tagName == "I")
            target = e.target.parentElement;
            
        if (!target.classList.contains("col") || target.classList.contains("empty-day"))
            return;

        if (selectedDayBlock) {
            if (selectedDayBlock.classList.contains("blue")) {
                selectedDayBlock.classList.remove("blue");
                selectedDayBlock.classList.remove("lighten-3");
            }
        }
        selectedDayBlock = target;
        selectedDayBlock.classList.add("blue");
        selectedDayBlock.classList.add("lighten-3");

        selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), parseInt(target.textContent, 10));

        showEvents();

        document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
            // month: "long",
           day: "2-digit",
        //   weekday:"long",
            // year: "numeric"
        });
        document.getElementById("weekDay").innerHTML=selectedDate.toLocaleString("en-US",{
             weekday:"long",
        });
    }

function slideUp(){
  var getTitle=document.getElementById("sideTitle");
    $('#sideTitle').slideToggle();
    
    
    var getBlur=document.getElementById("blur");
    getBlur.style.display="none";
    
    var getSched=document.getElementById("sched");
    sched.classList.remove("panel");
    sched.className="scroll";
    
    var getArrow=document.getElementById("SM");
    getArrow.style.display="none"
  
  
}    

<?php
    $arr=array();
    $arr2=array();
    $arr3=array();
    
    $file="files/CalInfo.txt";
    $targetf=fopen($file,"r") or die("Couldn't create file.");
    while(!feof($targetf)){
        $info = fgetcsv($targetf, 1000, ", "); ?>
        var Name="<?php echo $info[0]?>";
        var Desc="<?php echo $info[1]?>";
        var Dates=new Date("<?php echo $info[2]?>");
        Dates.setDate(Dates.getDate()+1)
    
        addEvent(Name,Desc,Dates,true);
    <?php }
    fclose($targetf); ?>
    
/*--------------------------------------------------------------CALL TO DATABASE FOR FUNDRAISERS-----------------------------------*/
    var Names=[];
    var Desc=[];
    var DateTime=[];
     var vari=0;
<?php
//will get rid of and will include this code through connection.php
  $conn=new mysqli("localhost", "david_gracias", "", "florida");
    if(mysqli_connect_errno()){echo mysqli_connect_error; exit;}

$results=mysqli_query($conn, "SELECT title, description, dateStart FROM fundraisers");


while(mysqli_num_rows($results)>0 && $row=mysqli_fetch_assoc($results)){ 
?>

 Names[vari]="<?php echo $row['title']?>";
  Desc[vari]="<?php echo $row['description']?>";
  DateTime[vari]="<?php echo $row['dateStart']?>";
 vari++;
 
<?php
}
?>


for(var i=0; i<Names.length; i++){
    addEvent(Names[i], Desc[i], new Date(DateTime[i]), true)
}

/*--------------------------------------------------------------CALL TO DATABASE FOR ITINERARY-----------------------------------*/
   var Times=[];
var Itinerary=[];
var counter=0;

 <?php

    
$response=mysqli_query($conn,"SELECT description, dateTime FROM itinerary");
while(mysqli_num_rows($response)>0 && $row2=mysqli_fetch_assoc($response)){
    
?>
Times[counter]="<?php echo $row2['dateTime']?>";

 
  counter++;
 <?php
 }
 

 ?>
for(var t=0; t<Times.length; t++){
    addEvent(t,"Filler", new Date(Times[t]),false)
}


</script>

