var button = document.getElementById("btn")
var output = document.getElementById("output")
var number
var counter

function init() {
// Convert string to primitve number
  number = parseInt(output.innerText)
      
/**
* Start counter by adding any number to start counting.
* In this case the ouput starts from 0 so to immediately
* invoke the button to increment the counter add 1 to start 
* counting in natural
* number (counting numbers).
*/  
counter = number + 1

function increment() {
  // Increment counter
  value = counter++
  output.innerText = value
}

// Output the increment value for every click
button.onclick = increment
}
window.onload = init

// Display results
