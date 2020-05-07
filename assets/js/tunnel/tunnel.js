$(document).ready(function () {


  //Recupere un tableau des div affichent les 5 blocs Q/R
  var allQuestions = $(".form-tunnel").find('div');
  var button = $(".button-tunnel")
  var containerButton = $(".button-tunnel-container")

  var questions = [
    $(".question_1, #reponse_1"),
    $(".question_3, #reponse_3"),
    $(".question_4, #reponse_4"),
    $(".question_5, #reponse_5")
  ]


  var longueur = questions.length 

  
 /*  var valeurs = [] */

  allQuestions.css("display", "none");
  questions[0].css("display", "flex");
  var reponses = $("label:not(label:first-child)");
  var i= 0
  var j = -1

     $(reponses).click(function () { 
         
     
          /* var val = this.innerHTML;
          valeurs.push(val)
          console.log(valeurs) */

         i++
         j++

        if (i >= questions.length){
       
          
          i--

          button.parent().css("display", "flex")
          containerButton.css("display", "block")

          /* $('.form-tunnel').submit(function (e) { 
            e.preventDefault();
            console.log('C\'est soumis');
            
          }); */
      
        }
           
          questions[i].css("display", "flex");
          questions[j].css("display", "none");
          
       
     
     });

    
        
});