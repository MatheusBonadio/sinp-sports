function slider(element){
  $(".header a").css("color","#646464");
  $(element).css("color","#fff");
  $(".header a").removeClass("active");
  $(element).addClass("active");
}

$(".header a").click(function(e){
    slider($(this));
});

$(document).on("scroll",function(){
    if($(document).scrollTop()<50){
        $('.header').removeClass('small');
    } else{
        $('.header').addClass('small');
    }
});