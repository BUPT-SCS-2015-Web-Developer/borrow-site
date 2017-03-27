	$("#cancel1").click(function (){
	var id=<?=$result["pk_id"]?>
	$.ajax({
		url:"borr_cancel.php",
		type:"POST",
		data:{
			id:id
			},
		success:function(){
			alert("取消成功");
		}
	})
})
