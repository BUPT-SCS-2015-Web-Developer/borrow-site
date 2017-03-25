$(function(){
	initwindow();

	$(window).resize(function(){
		initwindow();
	})
});
function initwindow(){
	$(".fb-img").width($(".fb .l5").width());
	$(".fb-img").height($(".fb-img").width()/4*3);
	$(".fb").height($(".fb>.row").height());
	$(".note").width($(".mainbar").width());
	$(".note").css("padding-left",$(".note").width()-$(".note ul").width());
}