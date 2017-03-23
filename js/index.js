$(".borr-qry").click(function (){
	var str = $(this).attr('id');
	borr_info = str.match(/\d+/g);
	$("#"+str).attr("disabled","disabled");
	$.ajax({
		url:"borr_work.php",
		type:"POST",
		dataType:'json',
		data:{
			site_id:borr_info[0],
			borr_date:borr_info[1],
			borr_period:borr_info[2],
		},
		complete:function(data){
			if (data.responseText==0) $("#"+str).html("已预约");
			else alert("申请失败");
			
		
		}
	})
}	)
