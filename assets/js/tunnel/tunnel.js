import '../../css/app.scss';


$(document).ready(function () {

/* Question 1 */
  var eau = $("label[for=\"reponse_1_1\"]")
  var terre = $("label[for=\"reponse_1_2\"]")
  var feu = $("label[for=\"reponse_1_3\"]")
  var air = $("label[for=\"reponse_1_4\"]")

  eau.addClass("eau")
  terre.addClass("terre")
  feu.addClass("feu")
  air.addClass("air")


  $(eau).append("<i class=\"fas fa-tint icn-eau\"></i>");
  $(terre).append("<i class=\"fas fa-leaf icn-leaf\"></i>");
  $(feu).append("<i class=\"fas fa-fire icn-fire\"></i>");
  $(air).append("<i class=\"fas fa-wind icn-wind\"></i>");


  /* Question 2 */
  var non = $("label[for=\"reponse_2_8\"]")
  var louche = $("label[for=\"reponse_2_9\"]")

  non.addClass("non-merci")
  louche.addClass("louche")

  $(non).append("<i class=\"far fa-times-circle icn-non\"></i>");
  $(louche).append("<i class=\"fas fa-grin-hearts icn-adrenaline\"></i>");



  /* Question 3 */
  var nu = $("label[for=\"reponse_3_10\"]")
  var devetu = $("label[for=\"reponse_3_11\"]")
  var habille = $("label[for=\"reponse_3_12\"]")

  nu.addClass("nu")
  devetu.addClass("devetu")
  habille.addClass("habille")

  $(nu).append("<i class=\"fas fa-battery-empty icn-nu\"></i>");
  $(devetu).append("<i class=\"fas fa-battery-half icn-devetu\"></i>");
  $(habille).append("<i class=\"fas fa-battery-full icn-habille\"></i>");


  /* Question 4 */

  var avant = $("label[for=\"reponse_4_5\"]")
  var maintenant = $("label[for=\"reponse_4_6\"]")
  var apres = $("label[for=\"reponse_4_7\"]")

  avant.addClass("avant")
  maintenant.addClass("maintenant")
  apres.addClass("apres")

  $(avant).append("<i class=\"fas fa-angle-left icn-avant-1\"></i>");
  $(avant).append("<i class=\"fas fa-angle-double-left icn-avant-2\"></i>");
  const iconePrev1 = $('.icn-avant-1')
  const iconePrev2 = $('.icn-avant-2')


  avant.hover(function () {
      iconePrev1.css("display", "none")
      iconePrev2.fadeIn()
      
    }, function () {
      iconePrev1.css("display", "initial")
      iconePrev2.css("display", "none")
    }
  );


  $(maintenant).append("<i class=\"fas fa-pause icn-pause\"></i>");
  $(maintenant).append("<i class=\"fas fa-play icn-play\"></i>");
  const iconePause = $('.icn-pause')
  const iconePlay = $('.icn-play')

  maintenant.hover(function () {
    iconePause.css("display", "none")
    iconePlay.fadeIn()
    
  }, function () {
    iconePlay.css("display", "none")
    iconePause.css("display", "initial")
  }
);



  $(apres).append("<i class=\"fas fa-angle-right icn-apres-1\"></i>");
  $(apres).append("<i class=\"fas fa-angle-double-right icn-apres-2\"></i>");
  
  const iconeNext1 = $('.icn-apres-1')
  const iconeNext2 = $('.icn-apres-2')


  apres.hover(function () {
    iconeNext1.css("display", "none")
    iconeNext2.css("display", "initial")
      
    }, function () {
      iconeNext1.css("display", "initial")
      iconeNext2.css("display", "none")
    }
  );

  var questions = $('label:first-child') ;
  questions.addClass("questions");
  console.log(questions);
  

  //Recupere un tableau des div affichent les 5 blocs Q/R
  var allQuestions = $(".form-tunnel").find('div');
  var button = $(".button-tunnel")
  var containerButton = $(".button-tunnel-container")

  var questionsReponse = [
    $(".question_1, #reponse_1"),
    $(".question_2, #reponse_2"),
    $(".question_3, #reponse_3"),
    $(".question_4, #reponse_4")
  ]


  var longueur = questionsReponse.length 



  allQuestions.css("display", "none");
  questionsReponse[0].css("display", "flex");
  var reponses = $("label:not(label:first-child)");
  reponses.addClass("reponses")
  var i= 0
  var j = -1

     $(reponses).click(function () { 

         i++
         j++

        if (i >= longueur){
       
          i--

          button.parent().css("display", "flex")
          containerButton.css("display", "block")
        }
           
        questionsReponse[i].css("display", "flex");
        questionsReponse[j].css("display", "none");  
     
     });        
});