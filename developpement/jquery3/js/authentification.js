//...
//... une fois css et html chargés
// Ouverture Jquery: 1ere ligne à écrire
$(document).ready(function() {


    ///// BOOTSTRAP SLIDER //////
    // Instantiate a slider
    var prixSlider = $("input#prix").slider();
    $("#prix").on("slide", function(slideEvt) {
        $("#prixCurrentValue").text(slideEvt.value);
    });
    $('#description').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold']]

        ],
        enterHtml: ''
    });

    //// JQUERY MASK //////

    $('#disponibilite').mask('00/00/0000');

    $('#codeBarre').mask('00000 00000 0');


    // JQUERY DATE PICKER ///
    $('#datetimepicker1').datetimepicker({
        format: "DD/MM/YYYY"
    });
    $('#datetimepicker2').datetimepicker({
        format: "LT"
    });

    /// BOOTSTRAP-COLORPICKER ////
    $('#couleur').colorpicker({ /*options...*/
    });

    



    ///////////// FONCTION D'AFFICHAGE //////////
    function show(message) {
        console.log(message);
    }

    ////// DEFINITION DES VARIABLES /////////

    var quantiteMax = 0;
    var regeX = {
        titre: /^[a-zA-Z0-9\-]{5,}$/,
        codeBarre: /^[0-9]{5}\ [0-9]{5}\ [0-9]$/,
        description: /(([\w\(\)\é\è\à\ù\&\.\,\ \!\?\\n\r]+)|(<\/?b>? ))(?: ([\w\(\)\é\è\à\ù\&\.\,\ \!\?\\n\r]+)|(<\/?(b|p|br)>)){9,}/,
        //([\w\(\)\é\è\à\ù\&\.\,\ \!\?\\n\r]+)|(<\/?b>)/
        // /[\w\(\)\é\è\à\ù\&\.\,<>\ \!\?\\n\r]/
        prix: /^[\d][\d]?\.?\,?([\d][\d])?\€$/,
        date: /^[0-3][0-9]\/[0-1][0-9]\/[0-9]{4}$/,
        heure:/^[0-2][0-9]\:[0-6][0-9]$/,
        image: /^(https:\/\/s3.amazonaws\.com\/)[a-z0-9\-\_\/]+(.jpg|.jpeg)$/,
        quantite: /^[0-9]+$/,
        motsClefs: /^\b[\wéèàù]+\b(,\b[\wéèàù]+\b)+?$/,
        couleurs: /^((#[0-9A-Fa-f]{3,6})|(rgba\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*((0.[1-9])|[01])\s*\)))$/

        //  /^(#[0-9A-F]{3,6})|(rgba\(([0-2][0-5][0-5],){3}[0-1].[0-9]\))$/
    };

    ////////// FEEDBACK EN COULEUR //////////
    function displayState(element, value) {
        if (value) {
            $('div.form-group:has(' + element + ')').removeClass('has-error').addClass('has-success');
        } else {
            $('div.form-group:has(' + element + ')').removeClass('has-success').addClass('has-error');
        }
    }

    ////////// TEST TITRE //////////
    function testTitre() {
        var titreInput = $('input#titre').val();
        var titreValid = false;
        titreValid = regeX.titre.test(titreInput);

        displayState("input#titre", titreValid);
    }

    /////// TEST CODE BARRE ////
    function testCodeBarre() {
        var codeBarreInput = $('input#codeBarre').val();
        var codeBarreValid = false;
        codeBarreValid = regeX.codeBarre.test(codeBarreInput);

        displayState("input#codeBarre", codeBarreValid);
    }

    /////// TEST DESCRIPTION ////
    function testDescription() {
        // var descriptionInput = $('textarea#description').val();
        var descriptionInput = $('textarea#description+div div.note-editable').html();
        // .replace(/(<\/?(br|p)\/?>)/g,'');
        // show(descriptionInput);
        var descriptionValid = false;
        var descriptionNb = 0;
        if (descriptionInput) {
            var descriptionMots = descriptionInput.split(/\b\w+\b/);
            descriptionNb = descriptionMots.length - 1;
        }
        descriptionValid = (regeX.description.test(descriptionInput)) && descriptionNb <= 10;

        // show(descriptionNb);

        descriptionValid = regeX.description.test(descriptionInput);

        displayState("textarea#description", descriptionValid);
    }



    ////////// TEST PRIX //////////
    function testPrix() {
        var prixInput = $('#prix').val() + "€";
        //var prixInput = prixSlider.value;
        show(prixInput);
        var prixValid = false;
        prixValid = regeX.prix.test(prixInput);

        displayState("input#prix", prixValid);
    }

    ////////// TEST DISPO //////////
    function testDispo() {
        var dispoValid = false;
        var dateNow = new Date();
        // show(dateNow);
        var dispoInput = $('input#disponibilite').val();
        // show("dispoInput " + dispoInput);
        dispoInputAr = dispoInput.split(/[/,-]/);
        // show(dispoInputAr);
        var dispoInputDate = new Date(dispoInputAr[2], dispoInputAr[1] - 1, dispoInputAr[0]);
        // show(dispoInputDate);

        dispoValid = dispoInputDate > dateNow && regeX.date.test(dispoInput);
        // show(dispoValid);


        displayState("input#disponibilite", dispoValid);
    }

    ////////// TEST HEURE DISPO //////////
    function testHeureDispo() {
        var heureInput = $('#h-disponibilite').val();
        //var heureInput = heureSlider.value;
        show(heureInput);
        var heureValid = false;
        heureValid = regeX.heure.test(heureInput);

        displayState("input#h-disponibilite", heureValid);
    }

    ////////// TEST IMAGE //////////
    function testImage() {
        var imageInput = $('input#image').val();
        var imageValid = false;
        imageValid = regeX.image.test(imageInput);

        if (imageValid) {
            var imageHTML = $(document.createElement('img'))
                .attr("src", imageInput);
            imageHTML.attr("class", "img-thumbnail img-responsive");
            imageHTML.css("margin-top", "10px");
            $("div.col-sm-6:has(input#image)").append(imageHTML);

        }

        displayState("input#image", imageValid);
    }

    ////////// TEST QUANTITE MAX //////////
    function testQuantiteMax() {
        var quantiteMaxInput = parseInt($('input#quantiteMax').val());
        // show(quantiteMaxInput);
        var quantiteMaxValid = false;
        quantiteMaxValid = regeX.quantite.test(quantiteMaxInput) && quantiteMaxInput < 10000;

        quantiteMax = quantiteMaxInput;
        displayState("input#quantiteMax", quantiteMaxValid);
    }

    ////////// TEST QUANTITE MIN //////////
    function testQuantiteMin() {
        var quantiteMinInput = parseInt($('input#quantiteMin').val());
        var quantiteMinValid = false;
        quantiteMinValid = regeX.quantite.test(quantiteMinInput) && quantiteMinInput < 10000 && quantiteMinInput <= quantiteMax;

        displayState("input#quantiteMin", quantiteMinValid);
    }

    ////////// TEST MOTS CLEFS //////////
    function testMotsClefs(noFeedback) {
        var motsClefsInput = $('textarea#motsClefs').val();
        var motsClefsValid = false;
        var motsClefs = motsClefsInput.match(/[^,]+/g);
        var motsClefsNb = 0;
        if (motsClefs) {
            motsClefsNb = motsClefs.length;
        } else {
            motsClefsNb = 0;
        }
        $("div.form-group:has(textarea#motsClefs) span.help-block").html("Mot(s) : " + motsClefsNb);
        motsClefsValid = regeX.motsClefs.test(motsClefsInput) && motsClefsNb >= 10;
        if (noFeedback) {} else {
            displayState("textarea#motsClefs", motsClefsValid);
        }
    }

    ////////// TEST COULEUR //////////
    function testCouleur() {
        var couleurInput = $('input#couleur').val();
        var couleurValid = false;
        couleurValid = regeX.couleurs.test(couleurInput);

        displayState("input#couleur", couleurValid);
    }

    ////////// AFFICHE AU CHAMP AUTRE TYPE DE VENTE //////////
    function afficheAutreType() {
        var typeVenteInput = $('select#typeVente').val();
        show(typeVenteInput);
        var isAlreadyThere = false;
        if (typeVenteInput == "Autre") {
            isAlreadyThere = $('#otherType').length;
            console.log(isAlreadyThere);

            if (!isAlreadyThere) {
                var newTextBoxDiv = $(document.createElement('div'))
                    .attr("class", 'form-group');
                newTextBoxDiv.html('<label class="col-sm-4 control-label">Veuiller spécifier :</label>' +
                    '<div class="col-sm-6"><input type="text" name="textbox" id="otherType" class="form-control" value="" ></div>');
                $('div.form-group:has(#typeVente)').after(newTextBoxDiv);
            }
        } else {
            if ($('#otherType')) {
                $('div.form-group:has(#otherType)').remove();
                isAlreadyThere = null;
            }
        }
        displayState("select#typeVente", true);
    }

    //// TEST DU TYPE DE VENTE //////
    function testType() {
        var typeVenteInput = $('select#typeVente').val();
        var typeVenteValid = false;
        // show(typeVenteInput);
        typeVenteValid = typeVenteInput;
        displayState("select#typeVente", typeVenteValid);

    }

    //// ON AGIT À L'ÉCRITURE DANS LE CHAMP MOTS CLEFS /////
    $('textarea#motsClefs').keyup(function() {
        testMotsClefs(true);
    });

    //// ACTION QUAND ON SELECT TYPE DE VENTE ////
    $('select#typeVente').change(function() {
        afficheAutreType();
    });
    //////

    //// ACTION QUAND ON QUITTE LE CHAMP IMAGE ////
    $('input#image').blur(function() {
        testImage();
    });
    //////

    //Selectionne mon bouton de formulaire et j'écoute le focus out
    $('button#createProduct').click(function() {
        testTitre();
        testCodeBarre();
        testDescription();
        testPrix();
        testDispo();
        testHeureDispo();
        testImage();
        testQuantiteMin();
        testQuantiteMax();
        testMotsClefs();
        testCouleur();
        testType();

    });



});
