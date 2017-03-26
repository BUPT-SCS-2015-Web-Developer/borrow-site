var imid;
$(function(){
	initwindow();

	$(window).resize(function(){
		initwindow();
	});

	selectDate();
	
	$(".time.abled a").click(function(){
		imid=$(this).attr("id");
		$(".modal-place").html($(this).parents('.fb-tim').siblings('.fb-title').text());
		$(".modal-date").html($(".dateSelect.selected").text());
		$(".modal-time").html($(this).text());
		var fbClass=$(this).parents('.fb').attr("class");
		var imgClass=fbClass.split(" ");
		$(".modal-img img").attr("src","img/"+imgClass[1]+".jpg");
	});
	$(".time.disabled a").click(function(){
		alert("该场地不可被预约");
	});
});
function initwindow(){
	$(".fb-img").width($(".fb .l5").width());
	$(".fb-img").height($(".fb-img").width()/4*3);
	$(".fb").height($(".fb>.row").height());
	$(".note").width($(".mainbar").width());
	$(".note").css("padding-left",$(".note").width()-$(".note ul").width());
	$(".time.disabled a").attr("href",'');
}
function selectDate(){
	$(".dateSelect").click(function(){
		switchdate(this);
		
		$(".dateSelect.selected").removeClass("selected");
		$(this).addClass("selected");
		//console.log($(".dateSelect.selected").text());
	});	
}
function selectTime(){

}
function switchdate(thisday){
	console.log(thisday);
	var i;
	for(i=0;i<5;i++){
		if($(thisday).hasClass("day-"+i)){
			console.log(i);
			$(".fday-"+i).removeClass("hide");
		}
		else{
			$(".fday-"+i).addClass("hide");
		}
	}
	
	/*$(".day-0").click(function(){
		$("#field").addClass("hide");
		$(".fday-0").removeClass("hide");
	})
	$(".day-1").click(function(){
		$("#field").addClass("hide");
		$(".fday-1").removeClass("hide");
	})
	$(".day-2").click(function(){
		$("#field").addClass("hide");
		$(".fday-2").removeClass("hide");
	})
	$(".day-3").click(function(){
		$("#field").addClass("hide");
		$(".fday-3").removeClass("hide");
	})
	$(".day-4").click(function(){
		$("#field").addClass("hide");
		$(".fday-4").removeClass("hide");
	})
	*/
}