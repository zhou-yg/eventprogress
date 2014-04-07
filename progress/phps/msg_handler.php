<?php
session_start();
$sqlOp = include 'Objects/SqlOp.php';
$db_name = "a0711135022";
$user_id = $_SESSION["id"];

$task_number = $_POST["task"];
$msg = $_POST["form_msg"];
$up_img = $_FILES["form_img"];
date_default_timezone_set("Asia/Shanghai");
$date = date("y:m:d:H:i");

if($task_number){
	if ($up_img["error"]==0) {
		
		$img_file_path = "../img/";
		$file_types = array("jpg","gif","bmp","jpeg","png");
		$up_img_type = substr(strrchr($up_img["name"], '.'), 1);
		$up_img_name = rand(0, 5000).$user_id.".png";
		
		if (in_array($up_img_type, $file_types)) {
			if (file_exists($img_file_path)) {
				if (move_uploaded_file($up_img["tmp_name"],$img_file_path.$up_img_name)) {

						/*
						echo $user_id;
						echo "<.br/>";
						echo $task_number;
						echo "<.br/>";
						echo $date;
						echo "<.br/>";
						echo $msg;
						echo "<.br/>";
						echo $up_img_name;
						echo "<.br/>";
						 */
						 
						$connectResult = $sqlOp->connectTo($db_name);
						
						if ($connectResult) {
							$queryResult = $sqlOp->queryTo("insert into progress_msgs values(NULL,$user_id,$task_number,'$date','$msg','$up_img_name')");
							
							if ($queryResult) {
								echo "<script>location.href='../progress_list.php'</script>";
							} else {
								echo "<script>alert('发布进度失败')</script>";
								echo "<script>location.href='../progress_list.php'</script>";
							}
						} else {
							echo "<script>alert('链接数据库失败')</script>";
							echo "<script>location.href='../progress_list.php'</script>";
						}
				} else {
					echo "<script>alert('文件保存失败，无法发送')</script>";
					echo "<script>location.href='../progress_list.php'</script>";
				}
			} else {
				echo "<script>alert('文件夹不存在，无法发送')</script>";
				echo "<script>location.href='../progress_list.php'</script>";
			}
		} else {
			echo "<script>alert('文件类型不对，无法发送')</script>";
			echo "<script>location.href='../progress_list.php'</script>";
		}
	} else {
		echo "<script>alert('没有图片，无法发送')</script>";
		echo "<script>location.href='../progress_list.php'</script>";
	}
}else{
	echo "<script>alert('没有任务，无法发送')</script>";
	echo "<script>location.href='../progress_list.php'</script>";
}
?>