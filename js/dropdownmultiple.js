$(document).ready(function(){

  $(".expandable").each(function(){
    $(this).data('defaultheight', $(this).height());
    $(this).data('state', true);
  });

	toggleExpansion(0);

  $(".expandable").click(toggleExpansion(1000));

  function toggleExpansion($time) {
     defaultheight = $(this).data('defaultheight');
     state = $(this).data('state');
     if ( state ) {

     $(this).animate({
         height: 20
         }, $time );
     } else {
     $( this ).animate({
         height: defaultheight
     }, $time );
     }
     $(this).data('state', !state);
  }
});
