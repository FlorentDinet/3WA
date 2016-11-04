//...
//... une fois css et html chargés
// Ouverture Jquery: 1ere ligne à écrire
$(document).ready(function() {


    function pushMeKitten(howMuch, howBig) {
        if (howMuch) {

            for (var i = 0; i < howMuch; i++) {
                // // random image en fonction du nombre d'image //
                // var numLow = 1;
                // var numHigh = howMuch;
                // var adjustedHigh = (parseFloat(numHigh) - parseFloat(numLow)) + 1;
                // var numRand = Math.floor(Math.random() * adjustedHigh) + parseFloat(numLow);
                // var kittyCard = "<div class='col m3'><div class='card'><div class='card-image'><img class='' src='http://placekitten.com/400/300?image=" + i + "' alt='' /></div></div></div>";
                // var kittyCard = "<div class='col m3'><div class='card'><div class='card-image'><a class='chocolat-image' href='http://placekitten.com/400/300?image=" + i + "' title='caption image 1'><img class='' src='http://placekitten.com/400/300?image=" + i + "' alt='kitteh #"+i+"' /></a></div></div></div>";
                var isDoubleSized = false;//i % 2;
                var kittyCard = "<div class='grid-item" + (isDoubleSized ? " grid-item--width2" : "") + "'><div class='card'><div class='card-image'><a class='chocolat-image' href='http://placekitten.com/1920/1080?image=" + i + "' title='caption image 1'><img class='image-responsive' src='http://placekitten.com/200/100?image=" + i + "' alt='kitteh #" + i + "' /></a></div></div></div>";
                $(".chocolat-parent").append(kittyCard);
            }
        }
    }

    pushMeKitten(16);

    var $grid = $('.grid').imagesLoaded(function() {
        // init Masonry after all images have loaded
        $grid.masonry({
            // options
            itemSelector: '.grid-item',
            // use element for option
            columnWidth: '.grid-sizer',
            percentPosition: true
        });
    });


    $('.chocolat-parent').Chocolat();
    // MATERIALIZE ///

    //  $('.materialboxed').materialbox();
    //console.log($('.card-image').val());`





    $('.card').mouseenter(function() {
        $(this).fadeTo("fast", 0.6);
        var alt = $(this).find("img").attr("alt");
        $("body").find("h1").html(alt);
    });
    $('.card').mouseleave(function() {
        $(this).fadeTo("fast", 1);
        $("body").find("h1").html("kitteh");
    });


});
