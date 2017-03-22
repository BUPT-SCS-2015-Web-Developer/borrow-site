$(".borr-cancel").click(function (){
	var st = $(this).attr('id');
	borr_info = st.match(/\d+/g);
	//$("#"+str).attr("disabled","disabled");
	$.ajax({
		url:"borr_cancel.php",
		type:"POST",
		data:{
			site_id:borr_info[0],
			borr_date:borr_info[1],
			borr_period:borr_info[2],
			},
		complete:function(){
			$("#"+st).html("取消成功");
		}
	})
})
