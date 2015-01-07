$(document).ready(function(){
  
  $("div").each(function(){
    $(this).data('defaultheight', $(this).height());
    $(this).data('state', false);
  });

$("div").animate({
         width: 300,
         height: 20
         }, 0 );

  $("div").click(function() {
     defaultheight = $(this).data('defaultheight');
     state = $(this).data('state');
     if ( state ) {
     
     $(this).animate({
         width: 300,
         height: 20
         }, 1000 );
     } else {
     $( this ).animate({
         width: 300,
         height: defaultheight 
     }, 1000 );
     }
     $(this).data('state', !state);
  });
});
