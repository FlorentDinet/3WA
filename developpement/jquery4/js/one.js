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
                var isDoubleSized = false; //i % 2;
                var kittyCard = "<div class='grid-item" + (isDoubleSized ? " grid-item--width2" : "") + (i===0 || i===1 || i===7 ? " weird" : "") + (i===6 || i===12 || i===13 || i===14 || i===15 ? " cute" : "") + "'><div class='card hoverable'><div class='card-image'><a class='chocolat-image' href='http://placekitten.com/1920/1080?image=" + i + "' title='caption image 1'><img class='image-responsive' src='http://placekitten.com/300/300?image=" + i + "' alt='kitteh #" + i + "' /></a></div><div class='card-reveal'><span class='card-title grey-text text-darken-4'>kitteh #" + i + "</span><p>Here is some more information about this product</p></div></div></div>";
                $(".chocolat-parent").append(kittyCard);
            }
        }
    }

    pushMeKitten(16);

    var $grid = $('.grid').imagesLoaded(function() {
        // init Isotope after all images have loaded
        $grid.isotope({
            // options
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer',
                gutter: '.gutter-sizer'
            }
        });
    });

    // filter items on button click
    $('.filter-button-group').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
    });


    $('.chocolat-parent').Chocolat();
    // MATERIALIZE ///

    //  $('.materialboxed').materialbox();
    //console.log($('.card-image').val());`





    // $('.card').mouseenter(function() {
    //     $(this).fadeTo("fast", 0.6);
    // });
    // $('.card').mouseleave(function() {
    //     $(this).fadeTo("fast", 1);
    // });


    $('.card').mouseleave(function() {
        $("body").find("h1").html("kitteh");

        $(this).find('.card-reveal').velocity({
            translateY: 0
        }, {
            duration: 225,
            queue: false,
            easing: 'easeInOutQuad',
            complete: function() {
                $(this).css({
                    display: 'none'
                });
            }
        });
    });
    $('.card').mouseenter(function() {
        var alt = $(this).find("img").attr("alt");
        $("body").find("h1").html(alt);

        $(this).find('.card-reveal').css({
            display: 'block'
        }).velocity("stop", false).velocity({
            translateY: '-100%'
        }, {
            duration: 300,
            queue: false,
            easing: 'easeInOutQuad'
        });
    });









});
