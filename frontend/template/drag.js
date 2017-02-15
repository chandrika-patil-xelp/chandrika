$('.menu_elm').mouseenter(function(){
  var l= $(this).index();
  $('.tab').removeClass('selec');
  $('.tabB').eq(l).find('.tab').addClass('selec');
});
$('.menu_elm').mouseleave(function(){
    $('.tab').removeClass('selec');
});
var staticCord=0;
var x=0;
var j=0;
var k=0;
var s=0;
var sEnd=0;
$(".rota").on("mousedown", function(e) {
  j=e.pageX;

});
$(".rota").on("mousemove", function(e) {
    if (e.which == 1) {
      //clearTimeout(stop);
        //$("span").text("X: " + e.pageX + " Y: " + e.pageY);
       x=e.pageX;
       var wid= $(window).width();
           var d= (wid/30)/1.3;
        //    var g=0;
        //    if(sEnd==1){
        //      g=0;
        //  }
        //  else{
        //    g = ((s* wid)/30 )/1.3;
        //   staticCord=0;
        //       sEnd=1;
        //  }
           staticCord=parseInt(staticCord);

             x=x+staticCord -j ;
             k=x/d ;
             k=(k) %30;
             k= Math.floor(k) ;
             $('.imgHolder').addClass('dn');
             $('.imgHolder').eq(k).removeClass('dn');
             i=k;

     }

    // else{
    //   staticCord=e.pageX;
    // }
});
$(".rota").on("mouseup", function(e) {
  staticCord=e.pageX;
});
var i =0;
function function1() {
   i=(i+1)%30;
 $('.imgHolder').addClass('dn');
 $('.imgHolder').eq(i).removeClass('dn');
}
function runner() {
   sEnd=0;
   function1();
  stop=  setTimeout(function() {
       runner();
   }, 70);
}
