<?php include_once 'phps/progress_list_init.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Progress List</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/init.css" />
		<link rel="stylesheet" type="text/css" href="css/style_msgslist.css" />
	</head>
	<body>
		<iframe id="headerIframe" src="header.html"></iframe>
		<div id="vir-body" >
			<div id="events_window">
				<div id="events_msgs_list">
					<?php
					for ($i=0; $i < count($msg_arr); $i++) {
						
						$who = $msg_arr[$i]["user_name"];
						$when_month = $msg_arr[$i]["date_arr"][1];
						$when_day = $msg_arr[$i]["date_arr"][2];
						$when_hour = $msg_arr[$i]["date_arr"][3];
						$when_min = $msg_arr[$i]["date_arr"][4];
						$task_id = $msg_arr[$i]["task_id"];
						$texts = $msg_arr[$i]["texts"];
						$img_src = $msg_arr[$i]["img"];
						
						echo "<div class='msg_one' >"; 
						echo "<div class='msg_one_name'>";
						echo $who;
						echo "</div>";
						echo "<div class='msg_one_content'>";
					 	echo "<span class='msg_one_content_topic'>#任务".$task_id."#</span>";
						echo $texts;
						echo "</div>";
						echo "<div class='msg_one_img'>";
						echo "<a href='img/$img_src'><img src='img/$img_src' width='60px' height='60px' /></a>";
						echo "</div>";
						echo "<div class='msg_one_time'>";
						echo $when_month."月".$when_day."日的".$when_hour.":".$when_min;
						echo "</div>";
						echo "</div>";
					}
					?>
					<!--
					<div class="msg_one" >
						<div class="msg_one_name">
							Name
						</div>
						<div class="msg_one_content">
							<span class="msg_one_content_topic">#mei pal jwdijq#</span>zzzzbugxxxxxxxxxxxxxxxxxxxx
							xxxxxxxxxxxxxxxx
							xxxxxxxxxxxxxxxxxxxxxxxxxx
							xxxxxxxxxxxxxxzzzzzzzzzzzzzzzzzzz
						</div>
						<div class="msg_one_img">
							<img src="xxx" width="60px" height="60px" />
							<img src="xxx" width="60px" height="60px" />
							<img src="xxx" width="60px" height="60px" />
						</div>
						<div class="msg_one_time">
							4月7日的22:00
						</div>
					</div>
					-->
				</div>
				<div id="events_target">
					<div id="target_title">
						当前正在完成的任务
					</div>
					<?php
					for ($i=0; $i < count($task_arr); $i++) {
						
						$task_id = $task_arr[$i]["id"];
						$task_name = $task_arr[$i]["task_name"];
						$task_user_name = $task_arr[$i]["user_name"];
						
						echo "<div class='target_one'>";
						echo $task_id.".".$task_name."(".$task_user_name.")";
						echo "<form class='target_complete' action='phps/task_complete.php' method='post'>";						
						echo "<input type='hidden' name='complete' value='$task_id' />";
						echo "<input class='target_complete_button' type='submit' value='完成' />";
						echo "</form>";
						echo "</div>";
					}
					?>
					<!--
					<div class="target_one">
						2.完成制作卡牌的工具(jyouger)
						<form class="target_complete" action="phps/task_complete.php" method="post">
							<input type="hidden" name="complete" value="1" />
							<input class="target_complete_button" type="submit" value="完成" />
						</form>
					</div>
					-->
				</div>
				<div id="target_sned">
					<form action="phps/task_handler.php" method="post">
						任务:
						<input id="target_obj" name="target_obj" type="text" />
						<input id="target_obj_sub" type="submit" value="发布" />
					</form>
				</div>
				<div id="events_send">
					<form id="send_form" action="phps/msg_handler.php" method="post" enctype="multipart/form-data">
						<?php
						if (count($task_arr)>0) {
							echo "<div class='form_content'>";
							echo "<label class='preTag' >任务:</label>";
							echo "<select name='task'>";
							
							for ($i=0; $i < count($task_arr); $i++) { 
								$task_id = $task_arr[$i]["id"];
								echo "<option value=$task_id>任务$task_id</option>";
							}
							
							echo "</select>";
							echo "</div>";
						}
						?>
						<!--
						<div class="form_content">
							<label class="preTag" >任务:</label>
							<select name="task">
								<option value="1">任务1</option>
								<option value="2">任务2</option>
								<option value="3">任务3</option>
							</select>
						</div>
						-->
						<div class="form_content">
							<label class="preTag" >进度:</label>
							<textarea id="form_msg" name="form_msg"></textarea>
						</div>
						<div class="form_content">
							<label class="preTag" >进度图:</label>
							<input id="form_img" name="form_img" type="file"  />
						</div>
						<div class="form_content">
							<input class="preTagRight" type="submit" value="发进度" />
							<input class="preTagRight" type="reset" value="重置" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="jlibs/in.js"></script>
</html>