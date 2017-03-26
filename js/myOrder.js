$(function(){
	initwindow();
	$(window).resize(function(){
		initwindow();
	});
})
function initwindow(){
	$("#main").css("min-height",$(window).height()-60);
}