import '../css/app.scss';
import 'noUiSlider/distribute/noUiSlider.css'
import noUiSlider from 'noUiSlider';

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



const slider = document.getElementById('price-slider');

if(slider){

    const range = noUiSlider.create(slider, {
        start: [0, 100],
        connect: true,
        range: {
            'min': 0,
            'max': 100
        }
    });

    range.on('slide', function(values, handle){
      console.log(values, handle);
      
    })
}

$(document).ready(function(){ 

  


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
          "filter": "blur(5px)"
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


 




