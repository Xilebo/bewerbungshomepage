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
		 $object.data('state', false);
		 $object.addClass('closed');
		 $object.removeClass('open');
     } else {
		 $object.animate({
			 height: defaultheight
		 }, $time );
		 $object.data('state', true);
		 $object.addClass('open');
		 $object.removeClass('closed');
     }

  }

   toggleExpansion($(".expandable > span").parent(), 0);
  $(".expandable > span").click(function() {
	toggleExpansion($(this).parent(),1000);
  });
});
