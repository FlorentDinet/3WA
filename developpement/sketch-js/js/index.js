var ctx = Sketch.create();
var time = 0;
var speed = 10000;
var flagTime = ctx.now;
var lineLength = 0.01;
var delay = 0;
var delaySpeed = 2/speed;
var delayTrigger = false;


// ACTIVE/DESACTIVE AU SURVOL LE DELAY //

ctx.mouseover = function () {
    delayTrigger = !delayTrigger;
};
ctx.mouseout = function () {
    delayTrigger = !delayTrigger;
};

// DESSIN ET ANIMATION DE ARC //

var arc = { 
    init : function(config) {
        this.radius = config.radius;
    },
    render : function (time) {
    if (delayTrigger) {
        if (delay >= 2) {
            delay = 2;
        } else {
            delay += delaySpeed;
        }
    } else {
        if (delay <= delaySpeed) {
            delay = 0;
        } else {
            delay -= delaySpeed;
        }
    }
    ctx.beginPath();
    ctx.arc(ctx.width / 2, ctx.height / 2, this.radius, (time - delay) * Math.PI, time * Math.PI + lineLength);
    ctx.lineWidth = 10;
    ctx.lineCap = 'round';
    ctx.strokeStyle = '#FFFFFF';
    ctx.shadowBlur = 10;
    ctx.shadowColor = "#AAAAAA";
    ctx.stroke();
}};


// COMPTE DE 0 à 2 en fonction du temps //

function circleRunning() {
    if (time >= 2) {
        flagTime = ctx.now;
    }
    time = (ctx.now - flagTime) / speed;
}


// INITIALISATION //

var arc2 = Object.create(arc);
var arc3 = Object.create(arc);
var arc4 = Object.create(arc);
arc.init({radius:100});
arc2.init({radius:150});
arc3.init({radius:200});
arc4.init({radius:230});

// ÉXÉCUTION À CHAQUE FRAME //

ctx.draw = function () {
    circleRunning();
    arc.render(time);
    arc2.render(time);
    arc3.render(time);
    arc4.render(time);
};