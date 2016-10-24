(function() { //IIFE




    "use strict";

    var listeGroup = {
        nbPhrases: 2,
        auteur: "",
        date: "",
        courant: "",
        poeme: [],
        demandePhrases: function() {
            for (var i = 0; i < this.nbPhrases; i++) {
                var phrase = "";
                var regX = new RegExp("^[a-zA-Z ]{10,100}");
                while (!regX.test(phrase)) {
                    phrase = prompt("Merci de saisir une phrase d'au moins 20 charactères");
                    console.log(phrase);
                }
                this.poeme.push(phrase);
                console.log(this.poeme);
            }
        },
        deboguer: function() {
            for (var phrase in this.poeme) {
                // var regex = new RegExp("[ '-]+", "g");
                var mots = this.poeme[phrase].split(/\b\w+\b/);
                var nb = mots.length - 1;
                console.log(
                    this.poeme[phrase],
                    "\n",
                    "nombre de mots dans cette phrase " + nb
                );
            }
        },
        compterMots: function() {
            var poeme = this.poeme.join("\n");
            var mots = poeme.split(/\b\w+\b/);
            var nb = mots.length - 1;
            // var nb = poeme.split(/\b\w+\b/).length - 1;
            return nb;
        },
        compterMoyNbMots: function() {
            return (this.compterMots() / this.poeme.length);
        },
        capitalise: function() {
            for (var phrase in this.poeme) {
                this.poeme[phrase] = this.poeme[phrase].charAt(0).toUpperCase() + this.poeme[phrase].substring(1).toLowerCase();
            }
        },
        integrer: function() {
            var ul = document.createElement('ul');
            ul.setAttribute('class' , 'list-group');


            for (var phrase in this.poeme) {
              var li = document.createElement('li');
              li.setAttribute('class' , 'list-group-item');
              var text = document.createTextNode(this.poeme[phrase]);
              li.appendChild(text);
              ul.appendChild(li);
            }

            document.querySelector('#poeme').appendChild(ul);

            // var htmlToInsert = '<ul class="list-group">';
            // for (var phrase in this.poeme) {
            //     htmlToInsert += '<li class="list-group-item">' + this.poeme[phrase] + '</li>';
            // }
            // htmlToInsert += '</ul>';
            // document.getElementById("poeme").innerHTML += htmlToInsert;
        },
        inBlockQuote: function() {
            document.querySelectorAll('#poeme ul').insertBefore(createElement(blockquote));
        }
    };


    listeGroup.demandePhrases();
    // listeGroup.deboguer();
    // console.log("Nombre de mots totals dans le poeme " + listeGroup.compterMots());
    // console.log("Moyenne de mots par phrase " + listeGroup.compterMoyNbMots());
    listeGroup.capitalise();
    listeGroup.integrer();
    listeGroup.inBlockQuote();


})(); // FIN DU IIFE
