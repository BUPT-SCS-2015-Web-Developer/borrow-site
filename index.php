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

	
	show_valid_days(5,5);
	$sites_n = get_sites();
	?>

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
	<!-- 放标题的部分，也方便以后加新功能 -->
	<div id="top">
		<div class="container">
			<div id="title" class="left">易班场地预约</div>
		</div>
	</div>

	<!-- 主体部分 -->
	<div id="main">
		<div id="date">
			<div class="container">
				<div class="row">
					<div class="col s1"></div>
					<?php
					$i=0;
					foreach($date as $eachdate) {
						if($i==0){
						?>
							<div class="dateSelect col s2 selected day-<?=$i?>"><?=$eachdate;?></div>
						<?php
						}else{
							?>
							<div class="dateSelect col s2 day-<?=$i?>"><?=$eachdate;?></div>
							<?php
						}
							
						$i++;
					}
					?>
					<div class="col s1"></div>
				</div>		
			</div>					
		</div>
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
			<!--将5天的预约信息一次echo出来，根据不同选择hide和show(js控制)-->
			<!-- TODO：点击每一个.time的时候能获取到fb的编号，这样就能输出是什么区域了 -->
			<!-- TODO：点击每个.time就会弹出模态框去要求用户核对信息，填写信息 -->
			
			<?php
				$j=0;
				foreach($date as $eachdate) {
					if($j==0){
						?>
					<ul id="field" class="fday-<?=$j?>">
					<?php
					}
					else{
						?>
						<ul id="field" class="fday-<?=$j?> hide">
						<?php
					}
					for($k=0;$k<$sites_n;$k++) {
						?>
					<li class="fb fb<?=$k+1?> z-depth-2">
					<div class="row">
						<div class="col l5 s12">
							<div class="fb-img center z-depth-2">
								<img src="img/fb<?=$k+1?>.jpg" style="width:100%; height:100%;" alt="">
							</div>
						</div>
						<div class="col l7 s12	">
							<div class="fb-title"><?=$site_name[$k]?></div>
							<div class="fb-tim">
								<div class="row">
								<?php
								for($i=0;$i<4;$i++){
									try{
										$query = $DBH->prepare("select count(*),borrow_id from borrow_info where site_id=? and date=? and period = ?");
										$query->bindParam(1,$site_id[$k]);
										$query->bindParam(2,$date_id[$j]);
										$query->bindParam(3,$i);
										$query->execute();
										$result=$query->fetch();
										$ifborred=$result['count(*)'];
									
									}catch(PDOException $e){
										die($e->getMessage());
									}
									if($ifborred == 0){
								?>
									<div class="col s6">
										<div class="time abled center-align">
											<a href="#confirm" id="s<?=$site_id[$k]?>-d<?=$date_id[$j]?>-p<?=$i?>"><?=9+2*$i?>点~<?=11+2*$i?>点</a> 
										</div>
									</div>
								
								<?php
									}else{
										?>
									<div class="col s6">
										<div class="time disabled center-align">
											<a href="#confirm" id="s<?=$site_id[$k]?>-d<?=$date_id[$j]?>-p<?=$i?>"><?=9+2*$i?>点~<?=11+2*$i?>点</a> 
										</div>
									</div>
								<?php
									}
									if($i==1){
										?>
										</div>
										<div class="row">
										<?php
									}
									?>
								<?php
							}
								?>
								</div>
							</div>
						</div>
					</div>
				</li>
					<?php
					}
					?>
				</ul>
						<?php
				
					
					$j++;
				}
			?>
				
			
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
		
	<!-- Modal Structure -->
	<div id="confirm" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4>请核对预约信息</h4>
			<div class="row">
				<div class="col l4">
					<div class="modal-img">
						<img src="" width="100%" height="100%" alt="">
					</div>
				</div>
				<div class="col l8">
					<div><span>预约地点：</span><span class="modal-place"></span></div>
					<div><span>预约日期：</span><span class="modal-date"></span></div>
					<div><span>预约时间：</span><span class="modal-time"></span></div>
				</div>
			</div>
			<h5>若信息无误，请填写个人信息</h5>
			<div class="row">
				<form action="" class="col s12">
					<div class="row">
						<div class="input-field col s6">
							<input type="text" id="icon_prefix" class="validate">
							<label for="icon_prefix">姓名</label>
						</div>
						<div class="input-field col s6">
							<input type="tel" id="icon_telephone" class="validate">
							<label for="icon_telephone">联系方式</label>
						</div>
						<div class="input-field col s12">
							<input type="text" id="icon_reason" class="validate">
							<label for="icon_reason">预约原因</label>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class="cancel modal-action modal-close waves-effect waves-green btn-flat">取消</a>
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn blue lighten-1">提交</a>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
			$('.modal').modal();
			
		});
	</script>
				

 
</html>




