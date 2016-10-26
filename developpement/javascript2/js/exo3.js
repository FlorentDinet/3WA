(function() { //IIFE

    "use strict";

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
                if (this.hasOwnProperty(i) && typeof this[i] != "function") {
                    if (demande) {

                        for (var y = 0; y < demande.length; y++) {

                            if (i == demande[y]) {
                                this[i] = prompt("Veuillez entrer votre " + i + " pour l'adresse " + this.id);
                            }
                        }
                    } else {
                        this[i] = prompt("Veuillez entrer votre " + i + " pour l'adresse " + this.id);
                    }
                }
            }
        },
        displayGPS: function() {
            alert("La latitude est de " + this.latitude + " et la longitude est de " + this.longitude);
        },
        departement: function() {
            var departementFrancais = [
                "01 Ain",
                "02 Aisne",
                "03 Allier",
                "04 Alpes-de-Haute-Provence",
                "05 Hautes-Alpes",
                "06 Alpes-Maritimes",
                "07 Ardèche",
                "08 Ardennes",
                "09 Ariège",
                "10 Aube",
                "11 Aude",
                "12 Aveyron",
                "13 Bouches-du-Rhône",
                "14 Calvados",
                "15 Cantal",
                "16 Charente",
                "17 Charente-Maritime",
                "18 Cher",
                "19 Corrèze",
                "2A Corse-du-Sud",
                "2B Haute-Corse",
                "21 Côte-d'Or",
                "22 Côtes-d'Armor",
                "23 Creuse",
                "24 Dordogne",
                "25 Doubs",
                "26 Drôme",
                "27 Eure",
                "28 Eure-et-Loir",
                "29 Finistère",
                "30 Gard",
                "31 Haute-Garonne",
                "32 Gers",
                "33 Gironde",
                "34 Hérault",
                "35 Ille-et-Vilaine",
                "36 Indre",
                "37 Indre-et-Loire",
                "38 Isère",
                "39 Jura",
                "40 Landes",
                "41 Loir-et-Cher",
                "42 Loire",
                "43 Haute-Loire",
                "44 Loire-Atlantique",
                "45 Loiret",
                "46 Lot",
                "47 Lot-et-Garonne",
                "48 Lozère",
                "49 Maine-et-Loire",
                "50 Manche",
                "51 Marne",
                "52 Haute-Marne",
                "53 Mayenne",
                "54 Meurthe-et-Moselle",
                "55 Meuse",
                "56 Morbihan",
                "57 Moselle",
                "58 Nièvre",
                "59 Nord",
                "60 Oise",
                "61 Orne",
                "62 Pas-de-Calais",
                "63 Puy-de-Dôme",
                "64 Pyrénées-Atlantiques",
                "65 Hautes-Pyrénées",
                "66 Pyrénées-Orientales",
                "67 Bas-Rhin",
                "68 Haut-Rhin",
                "69D16 Rhône",
                "69M16 Métropole de Lyon",
                "70 Haute-Saône",
                "71 Saône-et-Loire",
                "72 Sarthe",
                "73 Savoie",
                "74 Haute-Savoie",
                "75 Paris",
                "76 Seine-Maritime",
                "77 Seine-et-Marne",
                "78 Yvelines",
                "79 Deux-Sèvres",
                "80 Somme",
                "81 Tarn",
                "82 Tarn-et-Garonne",
                "83 Var",
                "84 Vaucluse",
                "85 Vendée",
                "86 Vienne",
                "87 Haute-Vienne",
                "88 Vosges",
                "89 Yonne",
                "90 Territoire de Belfort",
                "91 Essonne",
                "92 Hauts-de-Seine",
                "93 Seine-Saint-Denis",
                "94 Val-de-Marne",
                "95 Val-d'Oise",
                "971 Guadeloupe",
                "972 Martinique",
                "973 Guyane",
                "974 La Réunion",
                "976 Mayotte"
            ];
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
            var jumbo = '<div class="jumbotron">';
            jumbo += '<h2>Adresse ' + this.id + '</h2>';
            for (var i in this) {
                if (this.hasOwnProperty(i) && typeof this[i] != "function" && i != "id") {
                    jumbo += '<p>' + this[i] + '</p>';
                }
            }
            jumbo += '</div>';
            document.getElementById("container").innerHTML += jumbo;
        }
    };

    var carnetAdresse = {
        adresseDeLivraison: "",
        adresseDeFacturation: "",
        inititalisation: function() {
            this.adresseDeLivraison = adresse.init("Livraison");
            this.adresseDeFacturation = adresse.init("Facturation");
            this.adresseDeLivraison.displayAdresse();
            this.adresseDeFacturation.displayAdresse();
        }
    };

    // adresse.init();
    // adresse.displayGPS();
    // console.log(adresse.departement());
    // adresse.isVilleurbanne();
    // adresse.modifAdresseVille();

    // carnetAdresse.inititalisation();
    //
    // console.log(carnetAdresse.adresseDeLivraison);
    // console.log(carnetAdresse.adresseDeFacturation);

    function remplaceApoI() {
        var regxx = new RegExp("'[a-z0-9\-\.\, ]+\'");
        var substr = "'une citation'";
        var str = "Chaine de texte avec 'une citation' bien reloue";

        function remplaceur(match, p1, p2, p3, offset, string) {
            return "<i>" + match.substring(1, match.length - 1) + "</i>";
        }
        var res = str.replace(regxx, remplaceur);

        console.log(res);

    }





})(); // FIN DU IIFE
