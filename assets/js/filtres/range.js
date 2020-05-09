
import 'noUiSlider/distribute/noUiSlider.css'
import noUiSlider from 'noUiSlider';

/* Slider filtres */
const slider = document.getElementById('price-slider');

if(slider){

    const min = document.getElementById('min');
    const max = document.getElementById('max');
    var   prixMin = Math.floor(parseInt(slider.dataset.min, 5)/ 10) * 10;
    var   prixMax = Math.ceil (parseInt(slider.dataset.max, 5)/ 10) * 10;
    

    const range = noUiSlider.create(slider, {
        start: [prixMin || 0, max.value || prixMax],
        connect: true,
        step: 5,
        range: {
            'min': prixMin,
            'max': prixMax,
        }
    });

    
    range.on('slide', function(values, handle){
      console.log(values, handle);
      
      if (handle === 0){
        min.value = Math.round(values[0])
      }
      if (handle === 1){
        max.value = Math.round(values[1])
      }
    })
}