<canvas class="center-block" id="countdown"></canvas>
<?php $tripDate=nextTripYear($conn, true); ?>
<script>
    $(document).ready(function(){ resetCounter("countdown"); });
    $(window).on('resize focus', function(){ resetCounter("countdown"); });
    
    var countdownInterval=null;
    function resetCounter(id){
        //total days until from currentDate to tripDate
        var canvas=document.getElementById(id);
        var ctx=canvas.getContext("2d");
            ctx.lineWidth=8;
        var startR=-Math.PI/2;
        var lengthR=(Math.abs(canvas.width/6 - ctx.lineWidth) < Math.abs(canvas.height/2 - ctx.lineWidth))? Math.abs(canvas.width/6 - ctx.lineWidth) : Math.abs(canvas.height/2 - ctx.lineWidth);
        
        var totalSeconds, countdownArr;
        var countdownText=["year", "month", "day", "hour", "min", "sec"];
        var timer=[60 *60 *24 *365, 60*60*24*30, 60 *60 *24, 60 *60, 60, 1]; //y, m, d, h, m, s
        var start=-1;
        var numCircles=3;
        resetCountdownTimer();
        
        var fontSize=20;
            
        var timeUntil=Math.ceil( new Date().getTime()/1000/timer[start+numCircles-1] ) *timer[start+numCircles-1] - new Date().getTime()/1000;
        setTimeout(function(){
            clearInterval(countdownInterval);
            countdownInterval=setInterval(function(){ countdownFunction(); }, timer[start+numCircles-1]*1000 );
        }, timeUntil*1000); countdownFunction();
        
        
        function countdownFunction(){
            resetCountdownTimer();
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            ctx.fillStyle="white";
            ctx.textAlign="center";
            for(var y=0; y < countdownArr.length; y++){
                var n=start+y;
                var frac=(n == 0)? 4 : timer[n-1]/timer[n]; //years : all other
                drawMultiRadiantCircle( (2*y+1)*(lengthR + ctx.lineWidth) , canvas.height/2, 1, true);
                drawMultiRadiantCircle( (2*y+1)*(lengthR + ctx.lineWidth), canvas.height/2, countdownArr[y]/frac);
                ctx.beginPath();
                ctx.font="small-caps " +(fontSize*2)+"px Montserrat";
                    ctx.fillText(countdownArr[y], (2*y+1)*(lengthR + ctx.lineWidth), (canvas.height+fontSize*1.6)/2);
                ctx.font="small-caps " +fontSize+"px Montserrat";
                    ctx.fillText(countdownText[n], (2*y+1)*(lengthR + ctx.lineWidth), canvas.height - fontSize/2);
                ctx.closePath();
            }
        }
        
        function resetCountdownTimer(){
            totalSeconds=(new Date('<?php echo $tripDate; ?> 14:20:00').getTime() - new Date().getTime())/1000;
            if(totalSeconds < 0) totalSeconds=0;
            countdownArr=[];
            countdownText=["year", "month", "day", "hour", "min", "sec"];
            for(var x=0; x < countdownText.length; x++){
                var tempTime=Math.floor(totalSeconds / timer[x]);
                if(tempTime == 0 && (x<countdownText.length-numCircles) || countdownArr.length == numCircles)
                    continue;
                if(start== -1) start=x;
                countdownArr.push( tempTime );
                totalSeconds -=(tempTime * timer[x]);
                if(tempTime !=1)
                    if(countdownText[x].charAt(countdownText[x].length-1) !="s")
                        countdownText[x]+="s";
                else
                    if(countdownText[x].charAt(countdownText[x].length-1) == "s")
                        countdownText[x].substring(0, countdownText[x].length-1);
            }
        }
        
        function drawMultiRadiantCircle(xc, yc, rEnd, isOutline=false){
            
            /* color arrays MUST be at least 3 long */
            var radientColors=[];
                radientColors.push('#2D3774');
                radientColors.push('#5E74F4');
                radientColors.push('#5E74F4');
                radientColors.push('#62A2FE');
                radientColors.push('#62A2FE');
                radientColors.push('#65BCE7');
                radientColors.push('#65BCE7');
                //radientColors.push('#54C3FA');
            
            if(isOutline){
                ctx.lineWidth=11;
                ctx.lineCap="butt";
                ctx.beginPath();
                    ctx.strokeStyle=radientColors[0]+"";
                    ctx.arc(xc, yc, lengthR, 0, 2* Math.PI);
                    ctx.stroke();
                ctx.closePath();
            }
            
            ctx.lineWidth=8;
            if(isOutline) return;
                
            ctx.lineCap="round";
            ctx.lineWidth=8;
            var partLength=(2 * Math.PI) / (radientColors.length-1);
            var start=startR;
            rEnd=rEnd *2*Math.PI + start;
            var r=lengthR;
            var gradient=null;
            var startColor=null, endColor=null;
            for (var i=0; i < radientColors.length; i++) {
                startColor=radientColors[i];
                endColor=radientColors[(i + 1) % radientColors.length];
                
                // x start / end of the next arc to draw
                var xStart=xc + Math.cos(start) * r;
                var xEnd=xc + Math.cos(start + partLength) * r;
                // y start / end of the next arc to draw
                var yStart=yc + Math.sin(start) * r;
                var yEnd=yc + Math.sin(start + partLength) * r;
                ctx.beginPath();
                    gradient=ctx.createLinearGradient(xStart, yStart, xEnd, yEnd);
                    gradient.addColorStop(0, startColor);
                    gradient.addColorStop(1.0, endColor);
                    ctx.strokeStyle=gradient;
                    if(rEnd >=start)
                        ctx.arc(xc, yc, r, start, (rEnd > start+partLength)? start+partLength : rEnd);
                    ctx.stroke();
                ctx.closePath();
                
                start +=partLength;
            }
        }
    }
</script>