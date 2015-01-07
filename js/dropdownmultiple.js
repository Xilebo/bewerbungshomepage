$(document).ready(function(){
  
  $(".expandable").each(function(){
    $(this).data('defaultheight', $(this).height());
    $(this).data('state', false);
  });

$(".expandable").animate({
         height: 20
         }, 0 );

  $(".expandable").click(function() {
     defaultheight = $(this).data('defaultheight');
     state = $(this).data('state');
     if ( state ) {
     
     $(this).animate({
         height: 20
         }, 1000 );
     } else {
     $( this ).animate({
         height: defaultheight 
     }, 1000 );
     }
     $(this).data('state', !state);
  });
});
