$(document).ready(function(){
	$( document ).tooltip();
	$("div.logo").click(function(){
		$(this).animate({
			top: "50px"}
			, 2000, 'easeOutBounce');
		$("div.intro").animate({
			opacity: "1"}
			, 3000);
		var delay = 0;
		$(".submenu:lt(4)").delay(3000).each(function(){
			$(this).delay(delay).animate({
				top: "0px",
				opacity: "1"}
				, 1000, 'easeOutQuart');
			delay += 500;
		});
	});
	$(".submenu").hover(
		function(){
		$(this).animate({
			top: "-20px"}
			, 500, 'easeOutBounce');
	},
		function(){
		$(this).animate({
			top: "0px"}
			, 300);
	});
});