# IIFE immediately-invoked function expression

permet d'éviter d'avoir des variables globales qui entrent en collision avec d'autre script d'autres fichiers js. Tout est encapsulé / protégé dans :

(function () { … })();

# STRICT MODE

mode strict permet d'être plus strict au niveau du parser du navigateur, ";" type de variables etc...
https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Strict_mode

# DANS LES OBJETS LES VARIABLES NE DEVIENNENT PAS GLOBALES

mais on peut y accéder (dans le IIFE) avec objet.


# PARCOURIR UN TABLEAU POUR FAIRE UN TRAITEMENT

arr.reduce(callback[, valeurInitiale]);


/**
 *
 * Exercice du Poème à réaliser avec la css Boostrapp
 *
 * Manipulation Objet + Fonction +  DOM
 *
 ***********Avec les Normes IIFE et use strict**********
 *
 *  Créer un objet "listeGroup" qui permet avec ses attributs de  faire les choses suivantes:
 *
 *   + Stocke le nombre de phrases voulues du poème (nb fixé)
 *   + Stocke l'auteur du poème
 *   + Stocke la date du poeme
 *   + Stocke le courant du poème
 *   + Demander les phrases du poème à l'utilisateur en fonction du nombre. Une phrase de poème comporte au moins 20 caractères alphas (REGEX)
 *   + Deboguer:  dans la console , affcher chaque phrases avec leur nombre de mots dans les console
 *   + Compter: le nombre de mots totales des phrases du poème
 *   + Afficher: la moyenne du nb de mots des phrases du poème
 *   + Formater: Modifier le tableaux des  phrases pour que seule la premiere lettre soit en majuscule et que le reste en minuscule
 *   + Integrer: Avec la Manipulation DOM,afficher les phrases dans un list group de boostrapp: demo: http://getbootstrap.com/components/#list-group
 *   Bonus: Entourer tout le poème de la classe citation de Boostrapp
 *   et afficher les caractèristiques du poème (auteur citation, date) dns un paragraphe
 *   Bonus 2: Verifier que chaque phrase fasse au moins 5 mots
 *   Bonus 3: Créer un Objet TypePoeme qui appelera l'objet listeGroup pour dire si ce poeme est un Acrostiche ou pas
*/




/*
* Exercice du Carnet d'Adresse: Objet et Composition d'Objet
*/



/**
*
* Créer un objet Adresse qui a 5 attributs vide de valeur (null): Adresse, Ville, Code Postal, Pays, Longitude et Latitude
*
* Créer un attribut initialisation qui permet d'initialiser les 5 attributs par des valeurs entrées par l'utilisateurs
* Créer un attribut permettant d'afficher les coordonées GPS: Longitude et Latitude dans une phrase "La longitude est de ... et la latitude est de ..."
*
* Créer un attribut departement permettant de retourner le département à partir du code postal initialisé
*
* Créer un attribut permettant de dire si l'adresse est de Villeurbanne à partir du Zipcode ou à partir des coordonées GPS
*
* Créer un attribut qui permettra de modifier l'adresse et la ville de l'utilisateur.
*
* Créer un attribut permettant d'afficher dans le HTML toutes les informations de l'adresse  dans une classe Jumbotron
*
* Composition: Créer un nouvel objet CarnetAdresse avec 2 attributs:
* AdresseDeLivraison et AdresseDeFacturation
*
* Créer une methode initialisation permettant d'initialiser 2 objets Adresse dans les 2 attributs AdresseDeLivraison et AdresseDeFacturation
*
* Créer une methode render() permettant d'afficher l'adresse AdresseDeLivraison et l'AdresseDeFacturation dans des class jimbotron
*
* Bonus: Créer un attribut autreAdresse qui sera un tableau d'autres adresse
* Bonus2: Créer 2 attributs permettant d'ajouter ou de supprimer d'autre adresse
* Bonus3: Créer un attribut permettant d'afficher l'ensemble des sous-adresse dans un jubotron
*/
