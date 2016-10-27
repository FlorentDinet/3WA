//...
//... une fois css et html chargés
// Ouverture Jquery: 1ere ligne à écrire
$(document).ready(function() {


    //JE selectionne mon bouton de formulaire et j'écoute le clic
    $('form input').focusout(function() {
        // val() fonction jquery pour récupérer la valeur d'un input
        var emailInput = $('input#email').val();
        //longueur de la valeur de mon element email

var emailValid = false;
 var emailRegeX = /^[a-z0-9\-\.\_]+\@[a-z]+(.com|.fr|.net)$/;
 emailValid = emailRegeX.test(emailInput);

        if (emailInput.length < 3 || !emailValid ) {
            //css modifier la class css
            $('input#email').css('border', '2px solid pink');
        } else if (emailInput.length > 3 && emailValid ) {
            //css modifier la class css
            $('input#email').css('border', '2px solid green');
        }


        var pwInput = $('input#pw').val();
        //longueur de la valeur de mon element email
        var pwValid = false;
        var pwRegeX = /^[a-z0-9\-\_\@]{6,20}$/;

var isSame = emailInput == pwInput;

        pwValid = pwRegeX.test(pwInput); 
        if (pwInput.length < 3 || !pwValid || isSame) {
            //css modifier la class css
            $('input#pw').css('border', '2px solid pink');
        } else if (pwInput.length > 3 && pwValid && !isSame) {
            //css modifier la class css
            $('input#pw').css('border', '2px solid green');
        }

    });



});
