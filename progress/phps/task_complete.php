<?php
session_start();
$sqlOp = include 'Objects/SqlOp.php';
$db_name = "a0711135022";
$user_id = $_SESSION["id"];
header("text/html; charset=utf-8");
if ($user_id) {
	
	$task_id = $_POST["complete"];
	/*******************构建完成任务的消息*********************/
	date_default_timezone_set("Asia/Shanghai");
	$date = date("y:m:d:H:i");
	$msg = "完成了任务".$task_id;
	$img = "complete.png";
	
	$connectResult = $sqlOp->connectTo($db_name);
	if ($connectResult) {
			
		$queryResult = $sqlOp->queryTo("insert into progress_msgs values(NULL,$user_id,$task_id,'$date','$msg','$img')");
		if ($queryResult) {

			$queryResult = $sqlOp->queryTo("delete from progress_tasks where id='$task_id'");
			if ($queryResult) {
				//echo "<script>alert('连接数据库失败')</script>";
				echo "<script>location.href='../progress_list.php'</script>";
				
			} else {
				
			}
		} else {
			
		}
	} else {
		echo "<script>alert('连接数据库失败')</script>";
		echo "<script>location.href='../progress_list.php'</script>";
	}
} else {
	echo "<script>alert('未登录，无权限')</script>";
	echo "<script>location.href='../progress_list.php'</script>";
}

?>