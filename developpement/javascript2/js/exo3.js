(function() { //IIFE

    "use strict";

    function show(element) {
        console.log(element);
    }
    var adresse = {
        adresse: "",
        ville: "",
        codePostal: 0,
        pays: "",
        latitude: 0,
        longitude: 0,
        id: 0,
        init: function(id) {
            this.id = id;
            this.askUser();
            return this;
        },
        askUser: function(demande) {
            for (var i in this) {
                if (typeof this[i] != "function") {
                    if (demande) {
                        for (var y = 0; y < demande.length; y++) {
                            if (i == demande[y]) {
                                this[i] = prompt("Veuillez entrer votre " + i + " pour l'adresse " + this.id);
                            }
                        }
                    } else {
                        if (i == 'id' && !this.i) {
                            this[i] = prompt("Veuillez entrer votre " + i + " pour cette adresse ");
                        } else if (i !== 'id') {
                            this[i] = prompt("Veuillez entrer votre " + i + " pour l'adresse " + this.id);
                        }
                    }
                }
            }
        },
        displayGPS: function() {
            alert("La latitude est de " + this.latitude + " et la longitude est de " + this.longitude);
        },
        departement: function() {
            var codeDepartement = this.codePostal.substring(0, 2);
            return codeDepartement;
        },
        isVilleurbanne: function() {
            var gpsVilleurbanne = {
                "latitude": 45.771944,
                "longitude": 4.89017089999993
            };
            var sameLatitude = Math.abs(this.latitude - gpsVilleurbanne.latitude) < 0.01;
            var sameLongitude = Math.abs(this.longitude - gpsVilleurbanne.longitude) < 0.01;

            if (parseInt(this.codePostal) === 69100 || (sameLatitude && sameLongitude)) {
                alert("vous êtes à villeurbanne");
            }
        },
        modifAdresseVille: function() {
            this.askUser(["codePostal", "ville"]);
        },
        displayAdresse: function() {
            var adresseId = this.id;
            var jumbo = '<div class="jumbotron row" id="' + this.id + '"><div class="col-sm-10">';
            jumbo += '<h2>Adresse ' + this.id + '</h2>';
            for (var i in this) {
                if (this.hasOwnProperty(i) && typeof this[i] != "function" && i != "id") {
                    jumbo += '<p>' + this[i] + '</p>';
                }
            }
            jumbo += '</div><div class="col-sm-2 text-right"><button type="button" class="btn btn-danger delete" id="delete-' + this.id + '">Supprimer</button></div></div>';
            document.getElementById("container").innerHTML += jumbo;
            document.getElementById('delete-' + this.id).onclick = function fun() {
                carnetAdresse.delAdresse(adresseId);
                show("cmd del of " + adresseId);
                //validation code to see State field is mandatory.  
            }




        },
        hideAdresse: function() {
            var parent = document.getElementById("container");
            var child = document.getElementById(this.id);
            parent.removeChild(child);
        }
    };

    var carnetAdresse = {
        adresseDeLivraison: "",
        adresseDeFacturation: "",
        autresAdresses: [],
        inititalisation: function() {
            this.adresseDeLivraison = Object.create(adresse);
            this.adresseDeLivraison.init("Livraison");
            this.adresseDeFacturation = Object.create(adresse);
            this.adresseDeFacturation.init("Facturation");
        },
        addAdresse: function() {
            var newAdresse = Object.create(adresse);
            newAdresse.init();
            this.autresAdresses.push(newAdresse);
        },
        delAdresse: function(adresseId) {
            for (var i = this.autresAdresses.length - 1; i >= 0; i--) {
                if (this.autresAdresses[i].id === adresseId) {
                    this.autresAdresses[i].hideAdresse();
                    this.autresAdresses.splice(i, 1);
                }
            }
        },
        render: function() {

            if (this.adresseDeLivraison) {
                this.adresseDeLivraison.displayAdresse();
            }
            if (this.adresseDeFacturation) {
                this.adresseDeFacturation.displayAdresse();
            }

            for (var i = 0; i < carnetAdresse.autresAdresses.length; i++) {
                var element = carnetAdresse.autresAdresses[i];
                element.displayAdresse();
            }
        },
        displayAutresAdresses: function() {
            var jumbo = '<div class="jumbotron" id="AutresAdresses">';
            for (var i = 0; i < this.autresAdresses.length; i++) {
                var element = this.autresAdresses[i];

                jumbo += '<h2>Adresse ' + element.id + '</h2>';
                for (var y in element) {
                    if (element.hasOwnProperty(y) && typeof element[y] != "function" && y != "id") {
                        jumbo += '<p>' + element[y] + '</p>';
                    }
                }
            }
            jumbo += '</div>';
            document.getElementById("container").innerHTML += jumbo;
        }
    };




    // adresse.init();
    // adresse.displayGPS();
    // console.log(adresse.departement());
    // adresse.isVilleurbanne();
    // adresse.modifAdresseVille();

    carnetAdresse.addAdresse();


    carnetAdresse.render();
    // carnetAdresse.displayAutresAdresses();

    //
    // console.log(carnetAdresse.adresseDeLivraison);
    // console.log(carnetAdresse.adresseDeFacturation);

    // function remplaceApoI() {
    //     var regxx = new RegExp("'[a-z0-9\-\.\, ]+\'");
    //     var substr = "'une citation'";
    //     var str = "Chaine de texte avec 'une citation' bien reloue";
    //
    //     function remplaceur(match, p1, p2, p3, offset, string) {
    //         return "<i>" + match.substring(1, match.length - 1) + "</i>";
    //     }
    //     var res = str.replace(regxx, remplaceur);
    //
    //     console.log(res);
    //
    // }

})(); // FIN DU IIFE