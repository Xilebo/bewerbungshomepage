$(document).ready(function(){

	$(".expandable").children("div").css("display", "none");
	$(".expandable > span").click(function() {
		$(this).parent().toggleClass("open");
		$(this).parent().children("div").slideToggle();
	});
	
});
