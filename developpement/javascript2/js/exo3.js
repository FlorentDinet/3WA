(function() { //IIFE




    "use strict";


var adresse = {
  adresse : "",
  ville:"",
  codePostal: 0,
  pays:"",
  longitude: 0,
  latitude:0,
  init : function() {
    for (var i in this) {
      if (this.hasOwnProperty(i)) {
        this[i] = prompt("Veuillez entrer votre " + i);
      }
    }
  },
  displayGPS: function() {
    // display    
  }
};


})(); // FIN DU IIFE
