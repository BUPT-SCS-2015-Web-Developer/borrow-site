<?php
	/*对未来beginDay后showingDay天的日期赋值给全局变量*/
	function show_valid_days($beginDay,$showingDay) {
		global $date,$date_id;
		date_default_timezone_set('Asia/Shanghai');
		$nowTimeShow = date("Y年m月d日 H:i");
		$nowTime = date("H:i");
		$nowDate = date("Y-m月d日");
		$flag = 0;
		if ($nowTime >= "17:00")
		{
			$flag = 1;
		}
		else
		{
			;
		}
		for ($i=0;$i<$showingDay;$i++)
		{
			$date[$i] = date("m月d日",strtotime("+".($i+$flag+$beginDay)." day"));
			$date_id[$i] = date("Ymd",strtotime("+".($i+$flag+$beginDay)." day"));
		}
	}
	
	function get_sites() {
		global $site_id,$site_name,$DBH;
		try {
			$query = $DBH->prepare("select * from site_info");
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			//print_r($query->errorInfo());
			$i = 0;
			foreach($results as $result) {
				$site_id[$i] = $result['site_id'];
				$site_name[$i] = $result['name'];
				$i++;
			}
			return $i;
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	
	}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<?php
	session_start();
	
	$_SESSION['token']='123';
	$_SESSION['usrid']='988793';
	$_SESSION['name']='Atlas';
	/*验证易班的session*/
	if(!isset($_SESSION['token'])||!isset($_SESSION['usrid'])||!isset($_SESSION['name'])){
        exit('illegal access!');
	}else{
		$user_id=$_SESSION['usrid'];
	}
    include "assets/db_config.php";
    include "assets/connect.php";

 //    $date = array();
 //    $date_id = array();
	// $site_id = array();
	// $site_name = array();

    $date = array();
    $date_id = array();
	$site_id = array();
	$site_name = array();
	$flag1=1;
	$flag2=2;

	
	// show_valid_days(5,5);
	// $sites_n = get_sites();
	
	// for($j=0;$j<$sites_n;$j++) {
		?>
	<!-- 	<div><?=$site_name[$j]?></div> -->


	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Document</title>
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
	<script src="js/index.js"></script>
	<script src="js/common.js"></script>
	<script src="js/index.js"></script>
	<script src="js/index2.js"></script>
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/common.css">
</head>		
<html>
	<!-- 之前有部分PHP控制的内容被我转移到了PHPcontrol.html,当时尚不清楚设计如何就先将代码移动过去了 -->
	<!-- 放标题的部分，也方便以后加新功能 -->
	<div id="top">
		<div class="container">
			<div id="title" class="left">易班场地预约</div>
		</div>
	</div>

	<!-- 主体部分 -->
	<div id="main">
		<div id="mainbar" class="container">

			<!-- note是显示不同类型预约情况是什么样的
			不能预约的是蓝色的，后面.time的class是disabled
			能预约的是粉色的，后面.time的class是abled -->
			<div class="note valign-wrapper">
				<ul class="right">
					<li class="status sta1 left">
						<div class="sta1-smp left"></div>
						<div class="sta-desc sta1-desc right">已预约场地</div>
					</li>
					<li class="status sta2 right">
						<div class="sta2-smp left"></div>
						<div class="sta-desc sta2-desc right">可预约场地</div>
					</li>
				</ul>
			</div>


			<!-- 这里开始#field就是主题部分啦，.fb是三个部分的通用classname，分别是.fb1 .fb2 .fb3 -->
			<!-- TODO：点击每一个.time的时候能获取到fb的编号，这样就能输出是什么区域了 -->
			<!-- TODO：点击每个.time就会弹出模态框去要求用户核对信息，填写信息 -->
			<ul id="field">
				<li class="fb fb1 z-depth-2">
					<div class="row">
						<div class="col l5 s12">
							<div class="fb-img center z-depth-2">
								<img src="img/fb1.jpg" style="width:100%; height:100%;" alt="">
							</div>
						</div>
						<div class="col l7 s12	">
							<div class="fb-title">会议区1</div>
							<div class="fb-tim">
								<div class="row">
									<div class="col s6">
										<div class="time disabled center-align">
											<a href="#confirm">9:00-11:00</a> 
										</div>
									</div>
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">11:00-13:00</a>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">13:00-15:00</a>
										</div>
									</div>
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">15:00-17:00</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li class="fb fb2 z-depth-2">
					<div class="row">
						<div class="col l5 s12">
							<div class="fb-img center z-depth-2">
								<img src="img/fb2.jpg" style="width:100%; height:100%;" alt="">
							</div>
						</div>
						<div class="col l7 s12">
							<div class="fb-title">会议区2</div>
							<div class="fb-tim">
								<div class="row">
									<div class="col s6">
										<div class="time disabled center-align">
											<a href="#confirm">9:00-11:00</a> 
										</div>
									</div>
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">11:00-13:00</a>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">13:00-15:00</a>
										</div>
									</div>
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">15:00-17:00</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li class="fb fb3 z-depth-2" style="margin-bottom:0px;">
					<div class="row">
						<div class="col l5 s12">
							<div class="fb-img center z-depth-2">
								<img src="img/fb3.jpg" style="width:100%; height:100%;" alt="">
							</div>
						</div>
						<div class="col l7 s12">
							<div class="fb-title">会谈区</div>
							<div class="fb-tim">
								<div class="row">
									<div class="col s6">
										<div class="time disabled center-align">
											<a href="#confirm">9:00-11:00</a> 
										</div>
									</div>
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">11:00-13:00</a>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">13:00-15:00</a>
										</div>
									</div>
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm">15:00-17:00</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- 底部控制条，控制页面的跳转 -->
	<!-- TODO:不同的页面不同的selected -->
	<div id="bottom">
		<div class="row">
			<div id="fieldOrder" class="col s6 center-align func selected">租借场地</div>
			<div id="myOrder" class="col s6 center-align func">我的租借</div>
		</div>
	</div>
	<div>
		
		<!-- Modal Structure -->
  		<div id="confirm" class="modal">
    		<div class="modal-content">
      			<h4>模态标题</h4>
  				<p>一堆文本</p>
    		</div>
   			<div class="modal-footer">
      			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">同意</a>
    		</div>
  		</div>
		<script>
  			$(document).ready(function(){
    		// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    		$('.modal').modal();
  			});
  		</script>
	</div>
				

 
</html>




