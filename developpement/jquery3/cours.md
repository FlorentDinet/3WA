Créer un formulaire de Création de produit avec les validations suivantes:

   + Titre du produit (uniquement caractères alpha avec tiret minimum 5 caractères)
   + Code Barre: 11 caractères numérique au format XXXXX XXXXX X
   + Description: 10 mots avec des caractères alpha numérique avec espace et balises HTML <b>
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
