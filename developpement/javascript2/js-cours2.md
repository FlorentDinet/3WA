# IIFE immediately-invoked function expression

permet d'éviter d'avoir des variables globales qui entrent en collision avec d'autre script d'autres fichiers js. Tout est encapsulé / protégé dans :

(function () { … })();

# STRICT MODE

mode strict permet d'être plus strict au niveau du parser du navigateur, ";" type de variables etc...
https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Strict_mode

# DANS LES OBJETS LES VARIABLES NE DEVIENNENT PAS GLOBALES

mais on peut y accéder (dans le IIFE) avec objet.


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
