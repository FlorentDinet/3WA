(function() { //IIFE

    "use strict";

    var objet = {
        nb1: 10,
        nb2: 20,
        affichage: function() {
            console.log("Nb1 : " + this.nb1);
            console.log("Nb2 : " + this.nb2);
        }
    };

    console.log(objet);
    console.log(objet.nb2);
    console.log(objet.affichage());

    var smartPhone = {
        marque: "Apple",
        model: "5S",
        description: "Super Smartphone :)",
        appel: function(user) {
            console.log("Votre " + this.model + " reçoi un appel de " + user);
        },
        ecrire: function(message, user) {
            console.log("Votre " + this.model + " écris un SMS à " + user + " et le message suivant : " + message);
            this.appel(user);
        }
    };

    console.log(smartPhone.model);
    console.log(smartPhone.marque);
    console.log(smartPhone.appel('Florian'));
    console.log(smartPhone.ecrire('Objet de mon message', 'Florian'));

    var objetFonction = function() {
        return "coucou";
    };

    console.log(objetFonction());


})(); // FIN IIFE
