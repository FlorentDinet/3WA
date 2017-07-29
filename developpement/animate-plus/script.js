var randomColor = (function () {
  var randomInt = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  };
  return function () {
    var h = randomInt(0, 360);
    var s = randomInt(42, 98);
    var l = randomInt(38, 90);
    return "hsl(" + h + "," + s + "%," + l + "%)";
  };
})();

var jumpInCircle = function(map) {
  var params = new Map();
  params.set("el", map.get("el"));
  params.set("rotate", map.get("rotate"));
  params.set("translateY", [map.get("translateY"), 0]);
  params.set("complete", function() {
    params.get("el").removeAttribute("class");
  });
  animate(params);
};

var enableHover = function() {
  params.forEach(function(param) {
    var el = param.get("el");
    var rotation = param.get("rotate");
    var params = new Map();
    params.set("el", el);
    params.set("duration", 500);
    params.set("rotate", [rotation, rotation]);
    params.set("translateY", 215);
    params.set("easing", "easeOutCirc");
    params.set("complete", function() {
      jumpInCircle(params);
    });
    el.addEventListener("mouseover", function() {
      el.className = "disabled";
      animate(params);
    });
  });
};

var div = document.createElement("div");
var total = 100;
var params = [];

for (var i=0; i<total; i++) {
  var span = document.createElement("span");
  span.style.background = randomColor();

  var options = new Map();
  options.set("el", span);
  options.set("rotate", i*(360/total));
  options.set("duration", 3200);
  options.set("easing", "easeOutBounce");
  if (i == 0) options.set("complete", enableHover);

  params.push(options);
  div.appendChild(span);
}

document.body.appendChild(div);
params.forEach(animate);
