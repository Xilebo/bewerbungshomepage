$(document).ready(function(){

  $(".expandable").each(function(){
    $(this).data('defaultheight', $(this).height());
    $(this).data('state', true);
  });



  function toggleExpansion($object, $time) {
     defaultheight = $object.data('defaultheight');
     state = $object.data('state');
     if ( state ) {

     $object.animate({
         height: 20
         }, $time );
     } else {
     $object.animate({
         height: defaultheight
     }, $time );
     }
     $object.data('state', !state);
  }

   toggleExpansion($(".expandable"), 0);
  $(".expandable").click(function() {
	toggleExpansion($(this),1000);
  });
});
