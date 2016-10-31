//...
//... une fois css et html chargés
// Ouverture Jquery: 1ere ligne à écrire
$(document).ready(function () {

    function show(message) {
        console.log(message);
    }


    ////////// TEST PW CONFIRM //////////

    function testConfirm(feedback) {
        var pwInput = $('input#pw').val();
        var pwConfirmInput = $('input#pwConfirm').val();
        var isSamePw = pwConfirmInput == pwInput;
        displayState("input#pwConfirm", isSamePw && pwConfirmInput);
        if (feedback) {
            $("input#pwConfirm").addClass('animated shake');
        } else {
        $("input#pwConfirm").removeClass('animated shake');
        }
    }

    //////////


    ////////// AVALUATE PW POWER //////////

    var pwMinLength = 8;

    var pwPwRegeX = [
        /[a-z]/,
        /[0-9]/,
        /[\-\_\@]/
    ];
    var pwRegeX = /^[a-z0-9\-\_\@]{8,20}$/;

    var pwPw = 0;
    var isSameAsEmail = false;
    var pwValid = false;

    function testPwPower() {
        var pwInput = $('input#pw').val();
        var pwLength = 0;

        // TEST DE COMPLEXITE
        function testRegeX(value) {
            return value.test(pwInput);
        }
        var regeXTrue = pwPwRegeX.filter(testRegeX);
        var pwComplexity = regeXTrue.length;
        //

        // TEST LONGUEUR
        if (pwInput.length <= 8) {
            pwLength = pwInput.length;
        } else {
            pwLength = 8;
        }
        //
        var maxPw = pwPwRegeX.length * 3 + pwMinLength;

        pwPw = ((pwComplexity * 3 + pwLength) * 100) / maxPw;

        // TEST DE VALIDITE
        isSameAsEmail = pwInput == $('input#email').val();

        pwValid = !isSameAsEmail && pwRegeX.test(pwInput);

        return {
            progress: pwPw + '%',
            state: pwValid
        };
    }
    //////////

    ////////// ANIMATE PROGRESS BAR //////////
    function animateProgressBar(progressBarID, progress, state) {
        $(progressBarID).css('width', progress);
        show(state);
        switch (state) {
            case true :
            show('succes');
                $(progressBarID).removeClass('progress-bar-danger').addClass('progress-bar-success');
                break;
            case false :
            show('error');
                $(progressBarID).removeClass('progress-bar-success').addClass('progress-bar-danger');
                break;
            default:
                $(progressBarID).removeClass('progress-bar-danger').removeClass('progress-bar-success');
                break;
        }
    }
    //////////

    function testcodePostal() {
        ////////// TEST CODE POSTAL //////////
        var codePostalInput = $('input#codePostal').val();
        var codePostalValid = false;
        var codePostalRegeX = /^[0-9]{5}$/;
        codePostalValid = codePostalRegeX.test(codePostalInput);

        displayState("input#codePostal", codePostalValid);
        //////////
    }

    $('input#pw').keyup(function () {
        var pwPower = testPwPower();
        displayState("input#pw", pwPower.state);
        animateProgressBar('input#pw+div div.progress-bar', pwPower.progress, pwPower.state);
    });

    $('input#pwConfirm').keyup(function () {
        testConfirm();
    });

    $('input#codePostal').blur(function () {
        testcodePostal();
        autoCompVille();
    });


    function autoCompVille() {
        var codePostalInput = $('input#codePostal').val();
        // 69000 69009
        // 75000 75020 75116
        // 13001 13016
        var villesConnues = {
            "Lyon": /^((690)[0-9]{2})$/,
            "Paris": /^((750)[0-9]{2})|(75116)$/,
            "Marseille": /^((130)[0-9]{2})$/
        };

        for (var ville in villesConnues) {
            if (villesConnues[ville].test(codePostalInput)) {
                $('input#ville').val(ville);
                displayState("input#ville", true);
            }
        }
    }

    function displayState(element, value) {
        if (value) {
            $('div.form-group:has(' + element + ')').removeClass('has-error').addClass('has-success');
        } else {
            $('div.form-group:has(' + element + ')').removeClass('has-success').addClass('has-error');
        }
    }


    /// COMPTEUR DE CARACTERES /////

    $('textarea#biographie').keyup(function () {
        var biographieInput = $('textarea#biographie').val();
        if (biographieInput) {
            $('#helpBlock').text(biographieInput.length);
        } else {
            $('#helpBlock').text("");
        }

    });


    //// BOUTONS + - TAILLE POLICE HELP /////
    var fontSize = 1;

    $('button#fontMaximus').click(function () {

        fontSize++;
        $('#helpBlock').css('font-size', fontSize + "rem");
    });
    $('button#fontMinus').click(function () {
        if (fontSize > 1) {
            fontSize--;
        }
        $('#helpBlock').css('font-size', fontSize + "rem");
    });

    /////// REVEAL PASSWORD //////
    $('#revealPw').click(function () {
        if ($("#revealPw").is(':checked')) {
            $('#pw').attr('type', 'text');
        } else {
            $('#pw').attr('type', 'password');
        }
    });

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

        // val() fonction jquery pour récupérer la valeur d'un input

        ////////// TEST NOM //////////
        var nomInput = $('input#nom').val();
        var nomValid = false;
        var nomRegeX = /^[a-zéàè\-]{2,}$/;
        nomValid = nomRegeX.test(nomInput);

        displayState("input#nom", nomValid);

        //////////

        ////////// TEST PRENOM //////////
        var prenomInput = $('input#prenom').val();
        var prenomValid = false;
        var prenomRegeX = /^[a-zéàè\-\ ]{3,}$/;
        prenomValid = prenomRegeX.test(prenomInput);

        displayState("input#prenom", prenomValid);
        //////////

        ////////// TEST AGE //////////
        var ageInput = $('input#age').val();
        var ageValid = false;
        var ageRegeX = /^[1-9][8-9]|[2-9][0-9]$/;
        ageValid = ageRegeX.test(ageInput);

        displayState("input#age", ageValid);
        //////////

        ////////// TEST VILLE //////////
        var villeInput = $('input#ville').val();
        var villeValid = false;
        var villeRegeX = /^[a-zéàè\-]{3,}$/;
        villeValid = villeRegeX.test(villeInput);

        displayState("input#ville", villeValid);
        //////////

        ////////// TEST EMAIL //////////
        var emailInput = $('input#email').val();
        var emailValid = false;
        var emailRegeX = /^[a-z0-9\-\.\_]+\@[a-z]+(.com|.fr|.net)$/;
        emailValid = emailInput.length > 3 && emailRegeX.test(emailInput);

        displayState("input#email", emailValid);
        //////////

        testcodePostal();

        ////////// TEST AVATAR URL //////////
        var urlInput = $('input#avatarUrl').val();
        var urlValid = false;
        var urlRegeX = /^((http|ftp)s?:\/\/)[a-z0-9\.\-\_]+\.[a-z]{1,5}\/[a-z0-9\.\-\_]+(.jpg|.gif|.png)$/;
        urlValid = urlRegeX.test(urlInput);

        displayState("input#avatarUrl", urlValid);

        //////////

        ////////// TEST BIOGRAPHIE //////////
        var biographieInput = $('textarea#biographie').val();
        var biographieNb = 0;
        if (biographieInput) {
            var biographieMots = biographieInput.split(/\b\w+\b/);
            biographieNb = biographieMots.length - 1;
        }

        displayState("textarea#biographie", biographieNb >= 10);

        //////////
        testPwPower();
        //////////
        testConfirm("feedback");

        ///// VERIFIE SI LES CGU SONT ACCEPTEES ////

        displayState("#CGU", $("#CGU").is(':checked'));

    });



});