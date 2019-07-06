<canvas id='fireworks'></canvas>
<script>
    let canvas, context, SCREEN_WIDTH, SCREEN_HEIGHT, mousePos;
    
    const initialize = function(){
        SCREEN_WIDTH = window.innerWidth,
        SCREEN_HEIGHT = window.innerHeight;
        mousePos = {
            x: 400,
            y: 300,
        };
        canvas.width = SCREEN_WIDTH;
        canvas.height = SCREEN_HEIGHT;
    }
    

    particles = [],
    rockets = [],
    MAX_PARTICLES = 400,
    colorCode = 0;
    
    let midClickTimer = 0; 
    
    $(window).on('resize', (e) => {
        clearTimeout(resizeTimer);
        var resizeTimer = setTimeout(initialize(), 250);
    });
    
    
    // init
    $(document).ready(function() {
        canvas = document.getElementById('fireworks');
        context = canvas.getContext('2d');

        initialize();
        
        let launchInterval = setInterval(launch, 800);
        let loopInterval = setInterval(loop, 1000 / 60);
        
    });
    
    // update mouse position
    $(document).mousemove(function(e) {
        // e.preventDefault();
        mousePos = {
            x: e.clientX,
            y: e.clientY
        };
    });
    
    // launch special rockets!!!
    $(document).mousedown((e) => {
        switch(e.which){
            case 1: //leftClick
                if(rockets.length < 20)
                    launchMultiColor(2);
                break; 
            case 3: //RightClick for Jumbo Firework  
                if(midClickTimer <= 0){
                    launchSuperRocket();
                    midClickTimer = 4*60; 
                }
        }
        
    });
    
    const launch = function() {
        launchFrom(mousePos.x);
    }
    
    const launchFrom = function(x) {
        if (rockets.length < 10) {
            let rocket = new Rocket(x, false, 1, 5);
            rocket.explosionColor = Math.floor(Math.random() * 360 / 10) * 10;
            rocket.vel.y = Math.random() * -3 - 4;
            rocket.vel.x = Math.random() * 6 - 3;
            rocket.size = 8;
            rocket.shrink = 0.998;
            rocket.gravity = 0.01;
            rockets.push(rocket);
        }
    }
    const launchMultiColor = function(number){
        
        let vy =  Math.random() * -3 - 4;
        let vx = Math.random() * 6 - 3;
        
        for(let x = 0; x < number; x++){
            let rocket = new Rocket(mousePos.x, true, x, 5, false);
            rocket.explosionColor = Math.floor(Math.random() * 360 / 10) * 10;
            rocket.vel.y = vy;
            rocket.vel.x = vx;
            rocket.size = 8;
            rocket.shrink = 0.998;
            rocket.gravity = 0.01;
            rockets.push(rocket);
        }
    }
    const launchSuperRocket = function(){
        let vy =  -4;
        let vx = 0; 
        let explosionColor = Math.floor(Math.random() * 360 / 10) * 10;
        
        for(let x = 0; x < 4; x++){
            let rocket = new Rocket(SCREEN_WIDTH/2, true, x, 3, true);
            switch(x){
                case 1: 
                    rocket.explosionColor = explosionColor + 180; 
                    break; 
                case 2: 
                    rocket.explosionColor = explosionColor + 5; 
                    break; 
                case 3: 
                    rocket.explosionColor = explosionColor - 5; 
                    break; 
                default: 
                    rocket.explosionColor = explosionColor; 
            }
            rocket.vel.y = vy;
            rocket.vel.x = vx;
            rocket.size = 16;
            rocket.shrink = 0.997;
            rocket.gravity = 0.01;
            rocket.resistance = 1; 
            rockets.push(rocket);
        }
    }
    
    
    const loop = function() {
        midClickTimer--; 
        // clear canvas
        context.clearRect(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT);
    
        let existingRockets = [];
    
        for (let i = 0; i < rockets.length; i++) {
            // update and render
            rockets[i].update();
            rockets[i].render(context);
    
            //rocket explodes if: it's near the mouse; it's falling; random chance happens 
            if(rockets[i].checkExplode()){
                rockets[i].explode(); 
            }else{
                existingRockets.push(rockets[i]); 
            }
            
        }
    
        rockets = existingRockets;
    
        let existingParticles = [];
    
        for (let i = 0; i < particles.length; i++) {
            particles[i].update();
    
            // render and save particles that can be rendered
            if (particles[i].exists()) {
                particles[i].render(context);
                existingParticles.push(particles[i]);
            }
        }
    
        // update array with existing particles - old particles should be garbage collected
        particles = existingParticles;
    
        while (particles.length > MAX_PARTICLES) {
            particles.shift();
        }
    }
    
    function Particle(pos) {
        this.pos = {
            x: pos ? pos.x : 0,
            y: pos ? pos.y : 0
        };
        this.vel = {
            x: 0,
            y: 0
        };
        this.shrink = .97;
        this.size = 2;
    
        this.resistance = 1;
        this.gravity = 0;
    
        this.flick = false;
    
        this.alpha = 1;
        this.fade = 0;
        this.color = 0;
    }
    
    Particle.prototype.update = function() {
        // apply resistance
        this.vel.x *= this.resistance;
        this.vel.y *= this.resistance;
    
        // gravity down
        this.vel.y += this.gravity;
    
        // update position based on speed
        this.pos.x += this.vel.x;
        this.pos.y += this.vel.y;
    
        // shrink
        this.size *= this.shrink;
    
        // fade out
        this.alpha -= this.fade;
    };
    
    Particle.prototype.render = function(c) {
        if (!this.exists()) {
            return;
        }
    
        c.save();
    
        c.globalCompositeOperation = 'lighter';
    
        let x = this.pos.x,
            y = this.pos.y,
            r = this.size / 2;
    
        let gradient = c.createRadialGradient(x, y, 0.1, x, y, r);
        gradient.addColorStop(0.1, "rgba(255,255,255," + this.alpha + ")");
        gradient.addColorStop(0.8, "hsla(" + this.color + ", 100%, 50%, " + this.alpha + ")");
        gradient.addColorStop(1, "hsla(" + this.color + ", 100%, 50%, 0.1)");
    
        c.fillStyle = gradient;
    
        c.beginPath();
        c.arc(this.pos.x, this.pos.y, this.flick ? Math.random() * this.size : this.size, 0, Math.PI * 2, true);
        c.closePath();
        c.fill();
    
        c.restore();
    };
    
    Particle.prototype.exists = function() {
        return this.alpha >= 0.1 && this.size >= 1;
    };
    
    function Rocket(x, multi, groupNum, eHeightDiv, sr) {
        Particle.apply(this, [{
            x: x,
            y: SCREEN_HEIGHT }]
        );
        
        this.multi = multi;
        if(this.multi){
            this.groupNum = groupNum; 
            this.eHeightDiv = eHeightDiv; 
            this.sr = sr; 
        }
        this.explosionColor = 0;
        
    }
    
    
    Rocket.prototype = new Particle();
    Rocket.prototype.constructor = Rocket;
    Rocket.prototype.checkExplode = function(){
        //calc disance to mouse
        let distance = Math.sqrt(Math.pow(mousePos.x - this.pos.x, 2) + Math.pow(mousePos.y - this.pos.y, 2));
        // random chance of 1% if rockets is above the middle of the screen
        let randomChance = this.pos.y < (SCREEN_HEIGHT * 2 / 3) ? (Math.random() * 100 <= 1) : false;
        
        if(!this.multi){
            return (this.pos.y < SCREEN_HEIGHT / 5 || this.vel.y >= 0 || distance < 50 || randomChance);
        }else{
            return (this.pos.y < (SCREEN_HEIGHT + this.groupNum) / this.eHeightDiv || this.vel.y >= (0 + this.groupNum/10) || distance < (25 + this.groupNum));
        }
         
    }
    Rocket.prototype.explode = function() {
        let count = Math.random() * 10 + 80;
        let res; 
        if(!this.sr) 
            res = .92 
        else 
            res = .99; 
    
        for (var i = 0; i < count; i++) {
            let particle = new Particle(this.pos);
            let angle = Math.random() * Math.PI * 2;
    
            // emulate 3D effect by using cosine and put more particles in the middle
            let speed = Math.cos(Math.random() * Math.PI / 2) * 15;
    
            particle.vel.x = Math.cos(angle) * speed;
            particle.vel.y = Math.sin(angle) * speed;
    
            particle.size = 10;
    
            particle.gravity = 0.2;
            particle.resistance = res;
            particle.shrink = Math.random() * 0.05 + 0.93;
    
            particle.flick = true;
            particle.color = this.explosionColor;
    
            particles.push(particle);
        }
    }
    
    Rocket.prototype.render = function(c) {
        if (!this.exists()) {
            return;
        }
    
        c.save();
    
        c.globalCompositeOperation = 'lighter';
    
        let x = this.pos.x,
            y = this.pos.y,
            r = this.size / 2;
            
        let gradient = c.createRadialGradient(x, y, 0.1, x, y, r);
        gradient.addColorStop(0.1, "hsla("+this.color+", 100%, 100%, 1)");
        gradient.addColorStop(1, "rgba(255, 255, 255, .01)");
    
        c.fillStyle = gradient;
    
        c.beginPath();
        c.arc(this.pos.x, this.pos.y, this.flick ? Math.random() * this.size / 2 + this.size / 2 : this.size, 0, Math.PI * 2, true);
        c.closePath();
        c.fill();
    
        c.restore();
    }
</script>