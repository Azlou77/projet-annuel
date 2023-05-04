// Event on click button
document.addEventListener("click", addModal);

function addModal(){
    // Get the modal
    var modal = document.getElementById("myModal");
    // Get the button that opens the modal
    var btn = document.getElementById("btn");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
    modal.style.display = "none";
    }
    }
    // Display a side nabar
    var sideNav = document.getElementById("mySidenav");
    var openNav = document.getElementById("openNav");
    var closeNav = document.getElementById("closeNav");
    openNav.onclick = function() {
        sideNav.style.display = "block";
    }
    closeNav.onclick = function() {
        sideNav.style.display = "none";
    }
    
}