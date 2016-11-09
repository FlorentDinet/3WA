// albumId: 1
//
// id: 1
//
// thumbnailUrl: "http://placehold.it/150/30ac17"
//
// title: "accusamus beatae ad facilis cum similique qui sunt"
//
// url: "http://placehold.it/600/92c952"
//


$(document).ready(function() {
    // on récupère les données
    $.getJSON('https://jsonplaceholder.typicode.com/photos');

    // on clone notre patron html
    var cardPatron = $('#cardPatron').clone();
    cardPatron.attr('id','1');

    //$(".container .row").prepend($("#cardPatron").html());

    function display(albumId, howMuch) {

        var items = [];
        $.each(data, function(key, val) {

          $('.container .row').prepend(cardPatron);
        });


    }

    // display();

});
