<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>쪽지함</title>
<link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@700&display=swap" rel="stylesheet">

<style >
#message_box{font-family: 'Nanum Myeongjo', serif; }
#rv_btn,#sv_btn,#send_btn{
        border: solid 1px #000; 
        border-radius: 15px; 
        background-color:#000;
        text-align: center;
        color: #ffffff;
        height: 30px;
        width: 130px;
}
</style>
</head>
<body> 
<header>
   <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header>  
<section>

   	<div id="message_box">
	    <h3>
<?php
 		if (isset($_GET["page"]))
			$page = $_GET["page"];
		else
			$page = 1;

		$mode = $_GET["mode"];

		if ($mode=="send")
			echo "송신 쪽지함 > 목록보기";
		else
			echo "수신 쪽지함 > 목록보기";
?>
		</h3>
	    <div>
	    	<ul id="message">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">
<?php						
						if ($mode=="send")
							echo "받은이";
						else
							echo "보낸이";
?>
					</span>
					<span class="col4">등록일</span>
				</li>
<?php
	include '../dbConnection.php';

	if ($mode=="send")
		$sql = "select * from message where send_id='$userid' order by num desc";
	else
		$sql = "select * from message where rv_id='$userid' order by num desc";

	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $num    = $row["num"];
	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];

	  if ($mode=="send")
	  	$msg_id = $row["rv_id"];
	  else
	  	$msg_id = $row["send_id"];
	  
	  $result2 = mysqli_query($con, "select name from members where id='$msg_id'");
	  $record = mysqli_fetch_array($result2);
	  $msg_name     = $record["name"];	  
?>
				<li>
					<span class="col1"><?php echo $number?></span>
					<span class="col2"><a href="/letter/message_view.php?mode=<?php echo $mode?>&num=<?php echo $num?>"><?php echo $subject?></a></span>
					<span class="col3"><?php echo $msg_name?>(<?php echo $msg_id?>)</span>
					<span class="col4"><?php echo $regist_day?></span>
				</li>	
<?php
   	   $number--;
   }
   mysqli_close($con);
?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='/letter/message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li> <a href='/letter/message_box.php?mode=$mode&page=$i'> $i </a> <li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='/letter/message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
			<ul class="buttons">
				<li><button id="rv_btn" onclick="location.href='/letter/message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button id="sv_btn" onclick="location.href='/letter/message_box.php?mode=send'">송신 쪽지함</button></li>
				<li><button id="send_btn" onclick="location.href='/letter/message_form.php'">쪽지 보내기</button></li>
			</ul>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php";?>
</footer>
</body>
</html>
