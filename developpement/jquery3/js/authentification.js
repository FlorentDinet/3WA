//...
//... une fois css et html chargés
// Ouverture Jquery: 1ere ligne à écrire
$(document).ready(function () {


    ///////////// FONCTION D'AFFICHAGE //////////
    function show(message) {
        console.log(message);
    }

    ////// DEFINITION DES VARIABLES /////////

    var RegeX = {
        titre : /^[a-zA-Z0-9\-]{2,}$/,
        codeBarre : /^[0-9]{4}\ [0-9]{4}\ [0-9]$/,
        decription : //

    };

    ////////// FEEDBACK EN COULEUR //////////
    function displayState(element, value) {
        if (value) {
            $('div.form-group:has(' + element + ')').removeClass('has-error').addClass('has-success');
        } else {
            $('div.form-group:has(' + element + ')').removeClass('has-success').addClass('has-error');
        }
    }   

    ////////// TEST CODE POSTAL //////////
    function testcodePostal() {
        var codePostalInput = $('input#codePostal').val();
        var codePostalValid = false;
        var codePostalRegeX = /^[0-9]{5}$/;
        codePostalValid = codePostalRegeX.test(codePostalInput);

        displayState("input#codePostal", codePostalValid);
    }

    $('input#codePostal').blur(function () {
        testcodePostal();
        autoCompVille();
    });

    //////
    function lambda () {
        
        ////////// TEST AVATAR URL //////////
        var urlInput = $('input#avatarUrl').val();
        var urlValid = false;
        var urlRegeX = /^((http|ftp)s?:\/\/)[a-z0-9\.\-\_]+\.[a-z]{1,5}\/[a-z0-9\.\-\_]+(.jpg|.gif|.png)$/;
        urlValid = urlRegeX.test(urlInput);

        displayState("input#avatarUrl", urlValid);

        //////////

    }

    /////// REVEAL OTHERSPORT TEXTBOX //////
    $('div.radio input').click(function () {
        var isAlreadyThere = $('#otherSport').length;
        console.log(isAlreadyThere);
        if ($("#optionsRadios6").is(':checked')) {
            if (!isAlreadyThere) {
                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("class", 'form-group');
                newTextBoxDiv.html('<label class="col-sm-4 control-label">Veuiller spécifier :</label>' +
                    '<div class="col-sm-6"><input type="text" name="textbox" id="otherSport" class="form-control" value="" ></div>');
                $('div.form-group:has(#optionsRadios6)').after(newTextBoxDiv);
            }
        } else {
            if ($('#otherSport')) {
                $('div.form-group:has(#otherSport)').remove();
                isAlreadyThere = null;
            }
        }
    });


    //Selectionne mon bouton de formulaire et j'écoute le focus out
    $('button#createAccount').click(function () {

    });



});