
$(".loader_proxy img").one("load", function() {
  // $(this).closest(".img_holder").css({'display':'block'});

}).each(function() {
  $(".img_cont img").one("load", function() {
    $(this).closest(".img_cont").css({'display':'block'});
  }).each(function() {
    if(this.complete) $(this).load();
  });
});

$(document).ready(function(){

 $("#dragTrgt").click(function(){
 $('.lmenu4mble').addClass('trnst-100');
 $('body').removeClass('pFixed');
 $('.dragTrgt').css({width: '20px', left: '0px'});
});
    });
function showLeftMenu(flag) {
if (flag) {
$('.lmenu4mble').removeClass('trnst-100');
$('body').addClass('pFixed');
$('.dragTrgt').css({width: '50%', left: '250px'});

}
else {
$('.lmenu4mble').addClass('trnst-100');
$('body').removeClass('pFixed');
$('.dragTrgt').css({width: '20px', left: '0px'});
}
}
$('.p_cont').velocity({opacity:[0]}, { delay:0 , duration:0});
$('.top-bor').velocity({width:[0],height:['82%']} ,{ delay:0 , duration:0});
$('.side-bor').velocity({height:[0],width:['82%']}, { delay:0 , duration:0});
$('.prdctAdd1').mouseenter(function(){
$(this).find('.p_cont').addClass('fadeI');
$(this).find('.p_cont2').addClass('fadeU');
$(this).find('.top-bor').addClass('bor-hover1');
$(this).find('.side-bor').addClass('bor-hover2');
$(this).find('.side-borh').addClass('bor-hover2h');
$(this).find('.effect1').addClass('eff1_trigger').removeClass('eff1_triggerR');
$('.bor-hover1').velocity({width:['88%','0']}, {duration:300,  easing:"ease-in-out"});
$('.bor-hover2').velocity({height:['88%','0']}, {duration:300, easing:"ease-in-out"});
$('.bor-hover2h').velocity({height:['95%','0']}, {duration:300, easing:"ease-in-out"});
$('.fadeI').velocity({opacity:[1,0],translateY:[0,-50]}, {duration:400, easing:"ease-in-out"});
$('.fadeU').velocity({opacity:[1,0],translateY:[0,50]}, {duration:400, easing:"ease-in-out"});
});
$('.prdctAdd1').mouseleave(function (){

$('.fadeI').velocity('reverse');
$(this).find('.p_cont').removeClass('fadeI');
$(this).find('.effect1').addClass('eff1_triggerR').removeClass('eff1_trigger');
$('.fadeU').velocity('reverse');
  $(this).find('.p_cont2').removeClass('fadeU');

$('.bor-hover1').velocity('reverse');
$(this).find('.top-bor').removeClass('bor-hover1');

$('.bor-hover2').velocity('reverse');
$(this).find('.side-bor').removeClass('bor-hover2');
$(this).addClass("click_disa").delay(1000).queue(function(){
$(this).removeClass("click_disa").dequeue();
});
});
$('.largePrdct').mouseenter(function(){
$(this).find('.top-borL').addClass('bor-hover3');
$(this).find('.bot-borL').addClass('bor-hover3');
$('.bor-hover3').velocity({width:['70%','0'],opacity:[1 , 0.2]}, {duration:300, easing:"ease-in-out"});
});
$('.largePrdct').mouseleave(function (){
$('.bor-hover3').velocity('reverse');
$(this).find('.top-borL').removeClass('bor-hover3');
$(this).find('.bot-borL').removeClass('bor-hover3');
$(this).addClass("click_disa").delay(1000).queue(function(){
$(this).removeClass("click_disa").dequeue();
});

});
