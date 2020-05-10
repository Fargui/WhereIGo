import '../css/app.scss';
import './filtres/range'



/************************

// -- Menu 
------------------------------
// -- Le boutton menu est caché en desktop (header.scss) on lui mettra un #id
// -- Le menu est caché en mobile view mais le boutton menu est visible à présent (header-response.scss)
// -- Lorsqu'on a une certaine taille d'image
// -- Dérouler un menu lorsqu'on clique sur le bouton (Onclick)
*/

/* $('#btnMenu').click(function(e){
    e.preventDefault();
    $('header').toggleClass("open", 500, 'easeOutSine');
    
    
}) */



var eau = $('#reponse_1_1');

$(document).ready(function(){ 


 $(eau).append('<div id="eau"><i class="fas fa-water"></i></div>');
  
 /*  eau.hover(function () {
    console.log($('#reponse_1_1::before'));

    eau.animate({
      opacity: 0,
    }, 1000, function() {
      // Animation complete.
    });
  
   eau.css('background-image', 'url("/build/images/plage.jpeg")')
      
    }, function () {
      
      eau.animate({
        opacity: 1,
      }, 1000, function() {
        // Animation complete.
      });
    }
  );; */


if (window.matchMedia("(min-width: 992px)").matches) {
  var prevScrollpos = window.pageYOffset;
  window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    
    if (prevScrollpos > currentScrollPos) {
      $(".nav-links").css("top", "0");
    }else {
      $(".nav-links").css("top", "-100px");  
    }
    prevScrollpos = currentScrollPos;
  }

} else {
 

}

var blurBg = $(".blur-bg");
$(".toggle").click(function(e){
  e.preventDefault();
  $(".hideMenu").slideToggle(500);

  if($(this).text() == 'Menu')
  {
      $(this).text('Fermer');
      
      blurBg.css({
          "filter": "blur(2px)"
        });  
  }
  else
  {   
      $(this).text('Menu');   
      blurBg.css({ 
          "filter": "initial"
        });  
  }

}); 
});

 
      

    /*  var label = $('#placeHasCategories').find('label');

    console.log($(label));
     $($(label)).addClass(); */


 




//Si les reponses liées aux reponses dans l'url, on add du background à la div concernéé