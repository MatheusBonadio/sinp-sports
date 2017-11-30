var slideIndex = 1;
var timer;
var disable = false;
var timeBar = 5000;
var touchMove = 0, touchStart = 0;

window.onload = function(){
  var touch = document.getElementsByClassName("slideshow")[0];
  touch.addEventListener("touchstart",function(e){
    touchStart = e.changedTouches[0].clientX;
  });
  touch.addEventListener("touchmove",function(e){
    touchMove = e.changedTouches[0].pageX;
  });
  touch.addEventListener("touchend",function(){
    if((touchMove-90) > touchStart)
      plusSlides(-1);
    else if((touchMove+90) < touchStart)
      plusSlides(1);
    touchMove = 0;
  });
}

function plusSlides(n) {
  if(!document.getElementsByClassName("highlight_img").length)
    window.clearInterval(timer);
  else
    showSlides(slideIndex += n);
}

function currentSlide(n) {
  if(slideIndex!=n)
     showSlides(slideIndex = n);
}

function reset(d){
  window.clearInterval(timer);
  if(!d){
    timer = window.setInterval("plusSlides(1)", timeBar);
    disable = false;
  }
  else
    disable = true;
}

function showSlides(n) {
  reset();
  var container = document.getElementsByClassName("highlight_container")[0];
  var slides = document.getElementsByClassName("highlight_img");
  var lines = document.getElementsByClassName("highlight_line");
  var dots = document.getElementsByClassName("dots");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (var i = 0; i < lines.length; i++) {
      dots[i].className = dots[i].className.replace(" active_dots", "");
  }
  dots[slideIndex-1].className += " active_dots";

  lines[slideIndex-1].classList.remove("pause");
  lines[slideIndex-1].classList.remove("animation_line");
  lines[slideIndex-1].offsetWidth;
  lines[slideIndex-1].classList.add("animation_line");

  container.style.right = (slideIndex-1)*100+"%";
  container.style.transition = "right 1s";
}

showSlides(slideIndex);

document.getElementsByClassName("highlight_container")[0].addEventListener("click", function() {
  var play = document.getElementsByClassName("play");
  var lines = document.getElementsByClassName("highlight_line");
  if(!disable){
    reset(true);
    /*play[1].classList.remove("animation_play");
    play[1].offsetWidth;
    play[1].classList.add("animation_play");*/
    lines[slideIndex-1].classList.add("pause");
  }
  else{
    reset();
    /*play[0].classList.remove("animation_play");
    play[0].offsetWidth;
    play[0].classList.add("animation_play");*/
    plusSlides(1);
  }
});