


$(document).ready(function(){
slider = $('.bxslider').bxSlider();
slider.startAuto();

  $('.bxslider').bxSlider({
      speed:1000,
      infiniteLoop :true,
      randomStart:true,
      controls:true
  });
});