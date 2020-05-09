
import 'noUiSlider/distribute/noUiSlider.css'
import noUiSlider from 'noUiSlider';

/* Slider filtres */
const slider = document.getElementById('price-slider');

if(slider){

    const min = document.getElementById('min');
    const max = document.getElementById('max');
  
    const range = noUiSlider.create(slider, {
        start: [0 , 1000 ],
        connect: true,
        step: 5,
        range: {
            'min': 0,
            'max': 1000,
        }
    });

    min.value = 0;
    max.value = 1000;

    
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