/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './css/app.css';

// start the Stimulus application
import './bootstrap';


// set initial account
let count = 0;

// select value 
const value = document.querySelector('#value');
const btns = document.querySelectorAll('.btn');

btns.forEach(function(btn){
  btn.addEventListener('click', function(e){
    const styles = e.currentTarget.classList;
    if (styles.contains('decrease')){
      count--;
    
    value.textContent = count;
    } else if (styles.contains('increase')){
      count++;
    

    } else {
      count = 0;
    }
    value.textContent = count;
  });
});





