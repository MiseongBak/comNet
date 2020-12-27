<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>쪽지 상세</title>
<link rel="stylesheet" type="text/css" href="/css/common.css">
<link rel="stylesheet" type="text/css" href="/css/message.css">
<style>
 .button
    {
        border: solid 1px #000; 
        border-radius: 15px; 
        background-color:#000;
        text-align: center;
        color: #ffffff;
        height: 30px;
        width: 100px
    }
</style>

</head>
<body> 
<header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header>  
<section>
   	<div id="message_box">
	    <h3 class="title" color="black">
<?php
	$mode = $_GET["mode"];
	$num  = $_GET["num"];

	include '../dbConnection.php';
	$sql = "select * from message where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$send_id    = $row["send_id"];
	$rv_id      = $row["rv_id"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	if ($mode=="send")
		$result2 = mysqli_query($con, "select name from members where id='$rv_id'");
	else
		$result2 = mysqli_query($con, "select name from members where id='$send_id'");

	$record = mysqli_fetch_array($result2);
	$msg_name = $record["name"];

	if ($mode=="send")	    	
	    echo "송신 쪽지함 > 내용보기";
	else
		echo "수신 쪽지함 > 내용보기";
?>
		</h3>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?php echo $subject?></span>
				<span class="col2"><?php echo $msg_name?> | <?php echo $regist_day?></span>
			</li>
			<li>
				<?php echo $content?>
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button class="button" onclick="location.href='/letter/message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button class="button" onclick="location.href='/letter/message_box.php?mode=send'">송신 쪽지함</button></li>
				<li><button class="button" onclick="location.href='/letter/message_response_form.php?num=<?php echo $num?>'">답변 쪽지</button></li>
				<li><button class="button" onclick="location.href='/letter/message_delete.php?num=<?php echo $num?>&mode=<?php echo $mode?>'">삭제</button></li>
		</ul>
	</div> <!-- message_box -->
</section> 
<footer>
   <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php";?>
</footer>
</body>
</html>
