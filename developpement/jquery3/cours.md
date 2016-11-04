Créer un formulaire de Création de produit avec les validations suivantes:

   + Titre du produit (uniquement caractères alpha avec tiret minimum 5 caractères)
   + Code Barre: 11 caractères numérique au format XXXXX XXXXX X
   + Description: 10 mots avec des caractères alpha numérique avec espace et balises HTML<b>
   + Prix: AU format: XX.XX€ avec X un nombre
   + Disponibilité: date au format dd/mm/YYYY . Vérifier que cette date est dans le future avec la fonction Date()
   + Image: image que de type jpg ou jpeg provenant de Amazon S3. L'image apparait en miniature juste en dessous quand je quitte mon champs
   + Quantité minimum: nombre < 10000
   + Quantité maximum: nombre < 10000 et inférieur au maximum
   + Mot clefs: textarea avec la saisie de mot séparé par des virgule (on mettre un petit compteur de mot a coté)
   + Couleur: forma text au format hexadecimal #FFEE88 ou rgba(255,255,255,0.8)
   + Type de vente: liste déroulante avec pour items "Neuf" , "Occasion", "Dematerielisé", "Autre". Quand je selection Autre (change())
   cela me fait apparaitre un champs en dessous
   + Boutons "Créer cette fiche produit"


   Bonus: Utiliser le plugin Summernote en Jquery pour la description du Produit


   Bonus 2: Ajouter le champs "Heure de disponibilité" et verifier que le format soit XX:XX et que ce soit une heure valide (comprise entre 00 et 23 pour les heures et 00 à 60 minutes)
   
   
   *** Les plugins Jquery ***
   
   Bonus: Utiliser le plugin Summernote en Jquery pour la description du Produit
   Bonus 2: Intégrer le plugin Bootstrap SLider pour le prix https://github.com/seiyria/bootstrap-slider
   Bonus 3: Intégrer le plugin Jquery Mask piur le codebarre https://igorescobar.github.io/jQuery-Mask-Plugin/
   Bonus 3 : Intégrer le plugin Jquery Datepicker https://eonasdan.github.io/bootstrap-datetimepicker/
   Bonus 4: Intégrer le COlor picker http://www.eyecon.ro/colorpicker/

Bonus Ultime: Quand je soumet l formulaire et si la description est valide, J'affiche la description en dessous en entourant les texte @Compte Twitter par un lien <a> sur Twiter
                  et les #hashtag par des liens sur le hashtag de twitter
                  Les liens vers des images seront également remplacer par des images responsive


https://s3.amazonaws.com/codecademy-blog/assets/puppy-7_zps26e8a8d9.jpg

jquery mask