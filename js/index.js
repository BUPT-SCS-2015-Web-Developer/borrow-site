$("#submit").click(function (){
	
	var name=$("#icon_prefix").val();
	var contact=$("#icon_telephone").val();
	var reason=$('#icon_reason').val();
	borr_info = imid.match(/\d+/g);
	//alert(borr_info[1]);
	$.ajax({
		url:"borr_work.php",
		type:"POST",
		dataType:'json',
		data:{
			site_id:borr_info[0],
			borr_date:borr_info[1],
			borr_period:borr_info[2],
			name:name,
			contact:contact,
			reason:reason
		},
		complete:function(data){
			/*if (data.responseText==0) $("#"+str).html("已预约");
			else alert("申请失败");*/
			if (data.responseText==0) {alert("申请成功");location.reload();}
				else alert("申请失败");
			
		
		}
	})
}	)
