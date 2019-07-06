<canvas id="coaster"></canvas>
<canvas id="coaster2"></canvas>
<script>
    $(document).ready(function(){ resetCanvas("coaster"); });
    $(window).on('resize', function(){ resetCanvas("coaster"); });
    var coasterImages = [];
    for(var i = <?php echo ($funny)? "0" : "1";  ?>; i <= 4; i++){
        var tempImage = new Image(); tempImage.src='images/coaster'+i+'.png';
        coasterImages.push(tempImage)
    }
    var ImageCounter = -1;
    var coasterInterval=null, counter;
    function resetCanvas(id){
        clearInterval(coasterInterval);
        var canvas=document.getElementById(id);
        var ctx=canvas.getContext("2d");
        var x, y;
        var start=-40, end=550;
        var amp=(window.innerHeight < window.innerWidth)? .1*window.innerHeight:.075*window.innerWidth;
        canvas.width=window.innerWidth;
        canvas.height=2*(amp+1);
        canvas.style.position="absolute";
        canvas.style.top= -canvas.height + Math.abs( $("body").offset().top - $("#main").offset().top ) + $("#main").height() + "px"; //443px, don't delete castle
        //100% vh
        
        ctx.beginPath();
            ctx.moveTo(newX(start), newY(start));
            for(var i=start; i <= end; i++){
                x=newX(i);
                y=newY(i);
                ctx.lineTo(x, y);
            }
            
            ctx.strokeStyle="#CCC"; ctx.stroke();
            ctx.lineTo(canvas.width, canvas.height);
            ctx.lineTo(0, canvas.height);
            ctx.fillStyle="white"; ctx.fill();
        ctx.closePath();
        
        var rc=new coaster(); 
        var resetCoasterInterval=function(){
            clearInterval(coasterInterval);
            coasterInterval=setInterval(function(){
                if( !( counter <= end * 2 )){//(Math.random()*(end-start) +2) ) ){
                    ImageCounter = (ImageCounter+1) % coasterImages.length;
                    counter = Math.round(start-rc.width/2);
                }
                rc.update(counter++);
            }, rc.timer );
        }; resetCoasterInterval();
        
        
        function newX(i){
            return (i-start)/(end-start) *canvas.width;
        }
        function newY(i){
            //second amp
            var amp2 = amp*.55;
            var x = 3/2*180;
            var difference = (amp-amp2)*(1 - Math.sin(x * Math.PI/180) )
            if(i >= x)
                return difference + 1 + amp2*(1 - Math.sin(i * Math.PI/180) );
            
            
            return 1 + amp*(1 - Math.sin(i * Math.PI/180) );
        }
        function newAngle(i){
            //second amp
            var multiplier = 1;
            if(i >= 3/2*180)
                multiplier = .55;
                
            return -Math.cos( i * Math.PI / 180)*amp/canvas.height *multiplier;
        }
        
        function coaster(){
            this.timerSlow=16;
            this.timerFast=5;
            this.timer=this.timerSlow;
            this.amp=(window.innerHeight < window.innerWidth)? .09*window.innerHeight:.06*window.innerWidth;
            this.width=this.amp;
            this.height=this.amp;
            $("#"+id+"2").replaceWith( $('#'+id).clone(true).attr("id", id+"2") );
                
            this.canvas=document.getElementById(id+"2");
            this.canvas.height=this.canvas.height+this.height;
            this.canvas.style.top=parseInt(this.canvas.style.top, 10) - this.height+6 + "px"; //wheel height
            this.canvas.style.zIndex=4;
            this.ctx=this.canvas.getContext("2d");
        }
        coaster.prototype.update=function(i){
            this.x=newX(i)-this.width/2;
            this.y=newY(i)-1; //-1 bc of wheel
            this.timer=Math.round(this.timer * 100)/100;
            if(newAngle(i) < 0 && this.timer <= this.timerSlow)
                this.timer+= .10;
            if(newAngle(i+this.width/2) > 0 && this.timer >= this.timerFast)
                this.timer-= .18;
            this.timer=Math.round(this.timer * 100)/100;
            if( !(this.timer >= this.timerSlow || this.timer <= this.timerFast) )
                resetCoasterInterval();
                
                
            this.draw(i);
        };
        coaster.prototype.draw=function(i){
            this.ctx.save();
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.ctx.translate(this.x + this.width/2, this.y + this.height/2);
                this.ctx.rotate( newAngle(i) );
                this.ctx.beginPath();
                    this.ctx.drawImage(coasterImages[ImageCounter], -this.width/2, -this.height/2, this.width, this.height);
                this.ctx.closePath();
            this.ctx.restore();
        };
    }
    
</script>