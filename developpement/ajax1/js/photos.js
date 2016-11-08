$(document).ready (function() {
  $.getJSON('https://jsonplaceholder.typicode.com/photos')
  .done(function(datas) {
    console.log(datas);
  });

  function display(){
    
  }

});
