$(document).ready(function(){function t(t,e){if(t)for(var i=0;i<t;i++){var a=!1,o="<div class='grid-item"+(a?" grid-item--width2":"")+(0===i||1===i||7===i?" weird":"")+(6===i||12===i||13===i||14===i||15===i?" cute":"")+"'><div class='card hoverable'><div class='card-image'><a class='chocolat-image' href='http://placekitten.com/1920/1080?image="+i+"' title='caption image 1'><img class='image-responsive' src='http://placekitten.com/300/300?image="+i+"' alt='kitteh #"+i+"' /></a></div><div class='card-reveal'><span class='card-title grey-text text-darken-4'>kitteh #"+i+"</span><p>Here is some more information about this product</p></div></div></div>";$(".chocolat-parent").append(o)}}t(16);var e=$(".grid").imagesLoaded(function(){e.isotope({itemSelector:".grid-item",percentPosition:!0,masonry:{columnWidth:".grid-sizer",gutter:".gutter-sizer"}})});$(".filter-button-group").on("click","button",function(){var t=$(this).attr("data-filter");e.isotope({filter:t})}),$(".chocolat-parent").Chocolat(),$(".card").mouseleave(function(){$("body").find("h1").html("kitteh"),$(this).find(".card-reveal").velocity({translateY:0},{duration:225,queue:!1,easing:"easeInOutQuad",complete:function(){$(this).css({display:"none"})}})}),$(".card").mouseenter(function(){var t=$(this).find("img").attr("alt");$("body").find("h1").html(t),$(this).find(".card-reveal").css({display:"block"}).velocity("stop",!1).velocity({translateY:"-100%"},{duration:300,queue:!1,easing:"easeInOutQuad"})})});