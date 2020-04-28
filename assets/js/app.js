import '../css/app.scss';
import Headroom from "headroom.js";

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

$(document).ready(function(){ 
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
      var blurBg = $(".blur-bg");
      console.log($(blurBg));
    
      
});



var myElement = $(".nav-links");
var headroom  = new Headroom(myElement);

 console.log(headroom);
 

