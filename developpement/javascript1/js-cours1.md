javascript dans le body, toujours à la fin de la page avant </body>

commentaire comme css

camelCase première lettre à partir du deuxième mot en maj.

documentation officielle javascript
https://developer.mozilla.org/fr/docs/Web/JavaScript

déclarer plusieurs variable en les séparant avec des ,

PLUGINS
jshint plugin pour afficher les erreurs dans l'éditeur
indent-guide


Number() et String() pour convertir les types de var

julien@meetserious.com
@Symfomany
06 74 58 56 48

pour supprimer une valeur d'un tableau :
delete tableau[i];

attention la console affiche toujours l'ancienne longueur de tableau pour debugger ( quand on le modifie)

exo 1



/**
*
***************************************** Nombre d'Or *************************************


* Générer un nombre aléatoire entre 1 et 15 (Math.random())
* Demander à l'utilisateur  de deviner ce nombre aléatoire (prompt() et parseInt())
* Si le nombre est une lettre ou un caractères spécial , demander de resaisir le chiffre

* Il a perdu si...: Il a atteint 10 tentatives de devinette, afficher "Vous avez perdu"
* Il a gagné si...: Si le nombre saisis est le nombre aléatoire, on arrete le jeu et on affiche
  son nombre d'essai "Vous avez gagné au bout de 2 tentatives!"

* Bonus: On stockera tous les essais des nombres saisies dans un tableau
	et affichera tous ces essais si il a perdu avec la solution

* Bonus 2: On affichera si il est près du nombre à trouver selon un écart type de 2 ( +/- 2)
	Afficher le message "Vous êtes bouillant"

* Bonus 3: Demander le niveau d'entrée du jeu au début:
  niveau débutant(nombre aléatoire entre 1 et 15, 10 chances)
	niveau intermédiaire(nombre aléatoire entre 1 et 25, 8 chances)
	niveau professionnel (nombre aléatoire entre 1 et 40, 4 chances)

* Bonus 4: A l'aide d'une fonction et boucle, demander si il a perdu ou gagner
de vouloir rejouer ce qui relancera depuis le debut le jeu.
