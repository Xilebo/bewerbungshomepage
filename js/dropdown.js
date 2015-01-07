$(document).ready(function(){
  var state = false;
  var defaultheight = $("#effect").height();

  //init
  $( "#effect" ).animate({
    width: 300,
    height: 20
  }, 0 );

  $("#button").click(function() {
    if ( state ) {
      $( "#effect" ).animate({
        width: 300,
        height: 20
      }, 1000 );
    } else {
      $( "#effect" ).animate({
        width: 300,
        height: defaultheight
      }, 1000 );
    }
  state = !state;
  });
});
