$(function(){
    // var calendar = document.getElementById('cal-table');
    // var gridTable = document.getElementById("table-body");

    // var currentDate = new Date();
    // var selectedDate = currentDate;
    // var selectedDayBlock = null;
    // var globalEventObj = {};
    // var DateTimes = [];
    // var Events = document.getElementById('events');

    // function createCalendar(date, side) {
    //     var currentDate = date;
    //     var startDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

    //     var monthTitle = document.getElementById("month-name");
    //     var monthName = currentDate.toLocaleString("en-US", {
    //         month: "long"
    //     });
    //     var yearNum = currentDate.toLocaleString("en-US", {
    //         year: "numeric"
    //     });
    //     monthTitle.innerHTML = `${monthName} ${yearNum}`;

    //     if (side == "left")
    //         gridTable.className = "animated fadeOutRight";
    //     else
    //         gridTable.className = "animated fadeOutLeft";
        
    //     setTimeout(() => {
    //         gridTable.innerHTML = "";

    //         var newTr = document.createElement("div");
    //         newTr.className = "Calrow";
    //         var currentTr = gridTable.appendChild(newTr);

    //         for (let i = 1; i <= startDate.getDay(); i++) {
    //             let emptyDivCol = document.createElement("div");
    //             emptyDivCol.className = "col empty-day";
    //             currentTr.appendChild(emptyDivCol);
    //         }

    //         var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    //         lastDay = lastDay.getDate();

    //         for (let i = 1; i <= lastDay; i++) {
    //             if (currentTr.children.length >= 7)
    //                 currentTr = gridTable.appendChild(addNewRow());
                    
    //             let currentDay = document.createElement("div");
    //             currentDay.className = "col";
    //             console.log(selectedDate)
    //             if (selectedDayBlock == null && i == currentDate.getDate()) {
    //                 selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);

    //                 document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
    //                     month: "long",
    //                     day: "numeric",
    //                     year: "numeric",
    //                 });

    //                 selectedDayBlock = currentDay;
    //                 setTimeout(() => {
    //                     currentDay.classList.add("blue");

    //                 }, 900);
    //             }
    //             currentDay.innerHTML = i;

    //             //show marks
    //             if (globalEventObj[new Date(currentDate.getFullYear(), currentDate.getMonth(), i).toDateString()]) {
    //                 let eventMark = document.createElement("i");
    //                 eventMark.className = "day-mark fas fa-splotch fa-xs";
    //                 currentDay.prepend(eventMark);
    //             }

    //             currentTr.appendChild(currentDay);
    //         }


    //         for (let i = currentTr.getElementsByTagName("div").length; i < 7; i++) {
    //             let emptyDivCol = document.createElement("div");
    //             emptyDivCol.className = "col empty-day";
    //             currentTr.appendChild(emptyDivCol);
    //         }

    //         if (side == "left") {
    //             gridTable.className = "animated fadeInLeft";
    //         }
    //         else {
    //             gridTable.className = "animated fadeInRight";
    //         }

    //         function addNewRow() {
    //             let node = document.createElement("div");
    //             node.className = "Calrow";
    //             return node;
    //         }

    //     }, !side ? 0 : 270);
    // }
    // createCalendar(currentDate);

    // var superscript = "";
    // switch (currentDate.getDate() %10) {
    //     case 1:
    //         superscript = "st";
    //         break;
    //     case 2:
    //         superscript = "nd";
    //         break;
    //     case 3:
    //         superscript = "rd";
    //         break;
    //     default:
    //         superscript = "th";
    // }

    // var todayDayName = document.getElementById("todayDayName");

    // todayDayName.innerHTML = "Today is " + currentDate.toLocaleString("en-US", {
    //     weekday: "long",
    //     day: "numeric",
    //     month: "short"
    // });

    // var prevButton = document.getElementById("leftArrow");
    // var nextButton = document.getElementById("rightArrow");

    // prevButton.onclick = function changeMonthPrev() {
    //     currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1);
    //     createCalendar(currentDate, "left");
    // }
    // nextButton.onclick = function changeMonthNext() {
    //     currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1);
    //     createCalendar(currentDate, "right");
    // }

    
    // //Just admin??
    // function addEvent(title, desc, date) {
    //     selectedDate = date;
    //     if (!globalEventObj[selectedDate.toDateString()])
    //         globalEventObj[selectedDate.toDateString()] = {};
            
    //     globalEventObj[selectedDate.toDateString()][title] = desc;
    //     DateTimes[title] = date;
    // }


    // function showEvents() {
    //     let sidebarEvents = document.getElementById("sideEvents");
    //     let objWithDate = globalEventObj[selectedDate.toDateString()];

    //     sidebarEvents.innerHTML = "";

    //     if (objWithDate) {
    //         let eventsCount = 0;
    //         for (var key in globalEventObj[selectedDate.toDateString()]) {
    //             let eventContainer = document.createElement("div");
    //             eventContainer.className = "eventCard";
                
    //             let eventHeader = document.createElement("div");
    //             eventHeader.className = "eventCard-header";
                
    //             let eventDescription = document.createElement("div");
    //             eventDescription.className = "eventCard-description";
                
    //             eventHeader.appendChild(document.createTextNode(key));
    //             eventContainer.appendChild(eventHeader);
                
    //             eventDescription.appendChild(document.createTextNode(objWithDate[key]));
    //             eventContainer.appendChild(eventDescription);
                
    //             let markWrapper = document.createElement("div");
    //             markWrapper.className = "eventCard-mark-wrapper";
                
    //             sidebarEvents.appendChild(eventContainer);
                
    //             eventsCount++;
    //         }
    //     }
    //     else {
    //         let eventContainer = document.createElement("div");
    //         eventContainer.className = "eventCard";
            
    //         let eventHeader = document.createElement("div");
    //         eventHeader.className = "eventCard-header";
            
    //         let eventDescription = document.createElement("div");
    //         eventDescription.className = "eventCard-description";
            
    //         eventHeader.appendChild(document.createTextNode("Sorry, there are no events created for today"));
    //         eventContainer.appendChild(eventHeader);
            
    //         eventDescription.appendChild(document.createTextNode("Testig"));
    //         eventContainer.appendChild(eventDescription);
            
    //         let markWrapper = document.createElement("div");
    //         markWrapper.className = "eventCard-mark-wrapper";
            
    //         sidebarEvents.appendChild(eventContainer);
    //     }


    // }


    // gridTable.onclick = function(e) {
    //     var target = e.target;
    //     if(e.target.tagName == "I")
    //         target = e.target.parentElement;
            
    //     if (!target.classList.contains("col") || target.classList.contains("empty-day")) {
    //         return;
    //     }

    //     if (selectedDayBlock) {
    //         if (selectedDayBlock.classList.contains("blue")) {
    //             selectedDayBlock.classList.remove("blue");
    //             selectedDayBlock.classList.remove("lighten-3");
    //         }
    //     }
    //     selectedDayBlock = target;
    //     selectedDayBlock.classList.add("blue");
    //     selectedDayBlock.classList.add("lighten-3");

    //     selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), parseInt(target.textContent));

    //     showEvents();

    //     document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
    //         month: "long",
    //         day: "numeric",
    //         year: "numeric"
    //     });
    // }


    // addEvent("Testing", "Hello Everyone, hope we like the calendar", new Date(currentDate.getFullYear(), 5, 10, 1));
    

});





