
<?php
	session_start();
	include("assets/connect.php");
	if(!isset($_SESSION['token'])||!isset($_SESSION['usrid'])||!isset($_SESSION['name'])){
        exit('illegal access!');
	}else{
		$user_id=$_SESSION['usrid'];
	}
	date_default_timezone_set('Asia/Shanghai');
	$beginDate=date("Ymd",strtotime("+5 days"));
	$endDate=date("Ymd",strtotime("+9 days"));
	//date_add($nowDate,date_interval_create_from_date_string("4 days"));
	//print $endDate;

	try {
		$result = array();
		$query = $DBH->prepare("select pk_id,site_id,date,period from borrow_info where borrow_id = ? and date >= ? and date <= ?");
		$query->bindParam(1,$user_id);
		$query->bindParam(2,$beginDate);
		$query->bindParam(3,$endDate);
		$query->execute();	
		$result = $query->fetch();
		
	}
	catch(PDOException $e){
		die($e->getMessage());
	}


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>我的预约</title>
	<script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/myOrder.js"></script>

	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/common.css">

</head>
<body>
	<div id="top">
		<div class="container">
			<div id="title" class="left">易班场地预约</div>
		</div>
	</div>
	<div id="main">
		<div id="mainbar" class="container">
			<ul id="field" class="z-depth-1">
				<li class="mo z-depth-2">
					<div class="row">
						<div class="mo-img col l4 s12">
							<img class="z-depth-3" src="img/fb<?=$result["site_id"]?>.jpg" width="100%" height="100%" alt="">
						</div>
						<div class="col l8 s12">
							<div class="mo-desc">
								<?php if (!empty($result)) { ?>
								<div class="row"><span>预约地点：场地<?=$result["site_id"]?></span><span class="mo-place"></span></div>
								<div class="row"><span>预约日期：<?=$result["date"]?></span><span class="mo-date"></span></div>
								<div class="row"><span>预约时间：<?php echo(2*$result["period"]+9);echo("点~");echo(2*$result["period"]+11);echo("点");?></span><span spanclass="mo-time"></span></div>
								<?php } else {?>
									<div class="row"><span>预约地点:无</span><span class="mo-place"></span></div>
								<div class="row"><span>预约日期:无</span><span class="mo-date"></span></div>
								<div class="row"><span>预约时间:无</span><span spanclass="mo-time"></span></div>
							<?php  } ?>
								<a id="cancel1" class="btn waves-effect blue lighten-1 right">取消预约</a>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div id="bottom">
		<div class="row">
			<a href="./index.php" id="fieldOrder" class="col s6 center-align func">租借场地</a>
			<a href="./myorder.php" id="myOrder" class="col s6 center-align func selected">我的租借</a>
		</div>
	</div>
</body>
<script>
		$("#cancel1").click(function (){
	var id=<?=$result["pk_id"]?>;
	$.ajax({
		url:"borr_cancel.php",
		type:"POST",
		data:{
			id:id
			},
		success:function(){
			{alert("取消成功");location.reload();}
		}
	})
})

</script>
</html>