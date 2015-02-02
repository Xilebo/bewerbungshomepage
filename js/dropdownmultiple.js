$(document).ready(function(){

	$(".expandable").each(function(){
		$(this).data('defaultheight', $(this).height());
		$(this).data('isOpen', false);
	});

	function toggleExpansion($object, $time) {
		defaultheight = $object.data('defaultheight');
		isOpen = $object.data('isOpen');
		if ( isOpen ) {
			$object.toggleClass( "expandable", $time, "easeOutSine" );
			$object.data('isOpen', false);
			$object.addClass('closed');
			$object.removeClass('open');
		} else {
			$object.toggleClass( "expandable", $time, "easeOutSine" );
			$object.data('isOpen', true);
			$object.addClass('open');
			$object.removeClass('closed');
		}
	}

	$(".expandable > span").click(function() {
		toggleExpansion($(this).parent(),1000);
	});
});