$(document).ready(function(){
    var lowerSlider = document.querySelector('#lower');
var  upperSlider = document.querySelector('#upper');
var lowerSlider1 = document.querySelector('#lower1');
var  upperSlider1 = document.querySelector('#upper1');
var lowerSlider2 = document.querySelector('#lower2');
var  upperSlider2 = document.querySelector('#upper2');

document.querySelector('#two').value=upperSlider.value;
document.querySelector('#one').value=lowerSlider.value;
document.querySelector('#two1').value=upperSlider1.value;
document.querySelector('#one1').value=lowerSlider1.value;
document.querySelector('#two2').value=upperSlider2.value;
document.querySelector('#one2').value=lowerSlider2.value;

var  lowerVal = parseInt(lowerSlider.value);
var upperVal = parseInt(upperSlider.value);
var  lowerVal1 = parseInt(lowerSlider1.value);
var upperVal1 = parseInt(upperSlider1.value);
var  lowerVal2 = parseInt(lowerSlider2.value);
var upperVal2 = parseInt(upperSlider2.value);

upperSlider.oninput = function () {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);

    if (upperVal < lowerVal + 4) {
        lowerSlider.value = upperVal - 4;
        if (lowerVal == lowerSlider.min) {
        upperSlider.value = 4;
        }
    }
    document.querySelector('#two').value=this.value
};


upperSlider1.oninput = function () {
    lowerVal1 = parseInt(lowerSlider1.value);
    upperVal1 = parseInt(upperSlider1.value);

    if (upperVal1 < lowerVal1 + 4) {
        lowerSlider1.value = upperVal1 - 4;
        if (lowerVal1 == lowerSlider1.min) {
        upperSlider1.value = 4;
        }
    }
    document.querySelector('#two1').value=this.value
};
upperSlider2.oninput = function () {
    lowerVal2 = parseInt(lowerSlider2.value);
    upperVal2 = parseInt(upperSlider2.value);

    if (upperVal2 < lowerVal2 + 4) {
        lowerSlider2.value = upperVal2 - 4;
        if (lowerVal2 == lowerSlider2.min) {
        upperSlider2.value = 4;
        }
    }
    document.querySelector('#two2').value=this.value
};


lowerSlider.oninput = function () {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);
    if (lowerVal > upperVal - 4) {
        upperSlider.value = lowerVal + 4;
        if (upperVal == upperSlider.max) {
            lowerSlider.value = parseInt(upperSlider.max) - 4;
        }
    }
    document.querySelector('#one').value=this.value
};
lowerSlider1.oninput = function () {
    lowerVal1 = parseInt(lowerSlider1.value);
    upperVal1 = parseInt(upperSlider1.value);
    if (lowerVal1 > upperVal1 - 4) {
        upperSlider1.value = lowerVal1 + 4;
        if (upperVal1 == upperSlider1.max) {
            lowerSlider1.value = parseInt(upperSlider1.max) - 4;
        }
    }
    document.querySelector('#one1').value=this.value
};
lowerSlider2.oninput = function () {
    lowerVal2 = parseInt(lowerSlider2.value);
    upperVal2 = parseInt(upperSlider2.value);
    if (lowerVal2 > upperVal2 - 4) {
        upperSlider2.value = lowerVal + 4;
        if (upperVal2 == upperSlider2.max) {
            lowerSlider2.value = parseInt(upperSlider2.max) - 4;
        }
    }
    document.querySelector('#one2').value=this.value
};




$(function() {
    $("#price-range").slider({
      step: 25,
      range: true, 
      min: 0, 
      max: 100, 
      values: [0, 100], 
      slide: function(event, ui)
      {$("#priceRange").val(ui.values[0] + " - " + ui.values[1]);}
    });
    $("#priceRange").val($("#price-range").slider("values", 0) + " - " + $("#price-range").slider("values", 1));

    $("#price-range1").slider({
        step: 12.5,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {$("#priceRange1").val(ui.values[0] + " - " + ui.values[1]);}
      });
      $("#priceRange1").val($("#price-range1").slider("values", 0) + " - " + $("#price-range1").slider("values", 1));

      $("#price-range2").slider({
        step: 12.5,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {$("#priceRange2").val(ui.values[0] + " - " + ui.values[1]);}
      });
      $("#priceRange2").val($("#price-range2").slider("values", 0) + " - " + $("#price-range2").slider("values", 1));

      $("#price-range3").slider({
        step: 33.33,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {$("#priceRange3").val(ui.values[0] + " - " + ui.values[1]);}
      });
      $("#priceRange3").val($("#price-range3").slider("values", 0) + " - " + $("#price-range3").slider("values", 1));

      $("#price-range4").slider({
        step: 33.33,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {$("#priceRange4").val(ui.values[0] + " - " + ui.values[1]);}
      });
      $("#priceRange4").val($("#price-range4").slider("values", 0) + " - " + $("#price-range4").slider("values", 1));

      $("#price-range5").slider({
        step: 20,
        range: true, 
        min: 0, 
        max: 100, 
        values: [0, 100], 
        slide: function(event, ui)
        {$("#priceRange5").val(ui.values[0] + " - " + ui.values[1]);}
      });
      $("#priceRange5").val($("#price-range5").slider("values", 0) + " - " + $("#price-range5").slider("values", 1));
    
  });

// filter js

  $('.more_btn').click(function(){
        
    // $('.visual_indivisual').removeClass('flip');
    $(this).parents('.visual_indivisual').toggleClass('flip');
    if($(this).parents('.visual_indivisual').hasClass('flip')){
        $(this).text("Less");
    }else{
        $(this).text("More");
    }
    
});


$('.show_opt span').click(function(){
    $('.show_opt span').removeClass('active');
    $(this).addClass('active');

    if($('.list_show').hasClass('active')){
        $('.table').show();
        $('.visual_show').hide();
    }else{
        $('.visual_show').show();
        $('.table').hide();
    }
    
});

$('.like').click(function(){
    $(this).toggleClass('hit');
});

$('.followbtn').click(function(){
    $(this).parent().next().toggle();
    if($(this).parent().next().is(':visible')){
        $(this).text('Fewer Filter');
    }else{
        $(this).text('More Filter');
    }
   
});

});

