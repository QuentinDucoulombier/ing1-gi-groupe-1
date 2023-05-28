/*
* Function for a beautifull navbar
*/
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("header").classList.add("small_header");

    
  } else {
    document.getElementById("header").classList.remove("small_header");
  }
}