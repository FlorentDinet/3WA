var ctx = Sketch.create();
var time = 0;
var speed = 10000;
var flagTime = ctx.now;
var lineLength = 0.01;
var delay = 0;
var delaySpeed = 2 / speed;
var delayTrigger = false;


// ACTIVE/DESACTIVE AU SURVOL LE DELAY //

ctx.mouseover = function() {
    delayTrigger = !delayTrigger;
};
ctx.mouseout = function() {
    delayTrigger = !delayTrigger;
};

// DESSIN ET ANIMATION DE ARC //

var arc = {
    init: function(config) {
        this.radius = config.radius;
        this.rand = config.rand;
        this.delay = delay;
        this.time = 0;
        this.flagTime = ctx.now;
        this.position = config.rand ? config.rand : 0;
        this.width = config.rand ? abs(config.rand) * 5 : 10;
        this.speed = config.rand ? abs(config.rand) * 0.00001 : config.speed;
    },
    circleRunning: function() {
        if (this.time >= 2) {
            this.flagTime = ctx.now;
        }
        this.time = (ctx.now - this.flagTime) * this.speed;
    },
    render: function() {
        this.circleRunning();
        if (delayTrigger) {
            // RADIUS CHANGE
            if (this.radius >= 300) {
                this.radius = 1;
            } else {
                this.radius += 1;
            }
            // // ARC LENGTH CHANGE
            // if (this.delay >= 2) {
            //     this.delay = 2;
            // } else {
            //     this.delay += (delaySpeed);
            // }
        } else {
            // RADIUS CHANGE
            if (this.radius <= 1) {
                this.radius = 300;
            } else {
                this.radius -= 1;
            }
            // // ARC LENGTH CHANGE
            // if (this.delay <= delaySpeed) {
            //     this.delay = 0;
            // } else {
            //     this.delay -= delaySpeed;
            // }
        }
        ctx.beginPath();
        ctx.arc(ctx.width / 2,
            ctx.height / 2,
            this.radius,
            (((this.time - this.delay) + this.position) * Math.PI),
            (this.time + this.position) * Math.PI + lineLength);
        ctx.lineWidth = this.width;
        ctx.lineCap = 'round';
        ctx.strokeStyle = '#FFFFFF';
        ctx.shadowBlur = 10;
        ctx.shadowColor = "#AAAAAA";
        ctx.stroke();
    }
};


// COMPTE DE 0 à 2 en fonction du temps //

function circleRunning() {
    if (time >= 2) {
        flagTime = ctx.now;
    }
    time = (ctx.now - flagTime) / speed;
}


// POPULATE NOTRE CHAMP D'ETOILES //
var milkyWay = [];
var nombreEtoile = 200;
for (var i = 0; i < nombreEtoile; i++) {
    milkyWay[i] = Object.create(arc);
    milkyWay[i].init({
        radius: 2 * i,
        rand: random(-2, 2)
    });
}




// ÉXÉCUTION À CHAQUE FRAME //

ctx.draw = function() {
    // circleRunning();
    for (var i = 0; i < nombreEtoile; i++) {
        milkyWay[i].render();
    }
};
