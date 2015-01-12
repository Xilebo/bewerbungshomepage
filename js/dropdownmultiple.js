$(document).ready(function(){

	$(".expandable").each(function(){
		$(this).data('defaultheight', $(this).height());
		$(this).data('isOpen', true);
	});



	function toggleExpansion($object, $time) {
		defaultheight = $object.data('defaultheight');
		isOpen = $object.data('isOpen');
		if ( isOpen ) {
			$object.animate({
				height: 20
			}, $time );
			$object.data('isOpen', false);
			$object.addClass('closed');
			$object.removeClass('open');
		} else {
			$object.animate({
				height: defaultheight
			}, $time );
			$object.data('isOpen', true);
			$object.addClass('open');
			$object.removeClass('closed');
		}
	}

	toggleExpansion($(".expandable > span").parent(), 0);

	$(".expandable > span").click(function() {
		toggleExpansion($(this).parent(),1000);
	});
});
