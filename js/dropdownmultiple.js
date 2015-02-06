$(document).ready(function(){

	$(".expandable").each(function(){
		$(this).data('defaultheight', $(this).height());
		$(this).data('isOpen', false);
	});

	function toggleExpansion($object, $time) {
		defaultheight = $object.data('defaultheight');
		isOpen = $object.data('isOpen');
		if ( isOpen ) {
			$object.toggleClass( "closed", $time, "easeOutSine" );
			$object.data('isOpen', false);
			$object.removeClass('open');
		} else {
			$object.toggleClass( "closed", $time, "easeOutSine" );
			$object.data('isOpen', true);
			$object.addClass('open');
		}
	}

	$(".expandable > span").click(function() {
		toggleExpansion($(this).parent(),1000);
	});
});