<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>답장보내기</title>
<link rel="stylesheet" type="text/css" href="/css/common.css">
<link rel="stylesheet" type="text/css" href="/css/message.css">
<script>
  function check_input() {
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>

<style>
    #send_btn
    {
        border: solid 1px #000; 
        border-radius: 15px; 
        background-color:#000;
        text-align: center;
        color: #ffffff;
        height: 30px;
        width: 100px
    }
    
   input[type="text"] ,textarea
    {
        border: solid 1px #000; 
        border-radius: 10px; 
        background-color:#000; 
        height: 40px; 
        width: 250px;
        text-align: center;
        color: #ffffff;
    }

</style>

</head>
<body> 
<header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header>  
<section>
	
   	<div id="message_box">
	    <h3 id="write_title">
	    		답변 쪽지 보내기
		</h3>
<?php
	$num  = $_GET["num"];

	$con = mysqli_connect("", "", "", "");
	mysqli_query($con, "set session character_set_connection=utf8;");
	mysqli_query($con, "set session character_set_results=utf8;");
	mysqli_query($con, "set session character_set_client=utf8;");
	
	$sql = "select * from message where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$send_id      = $row["send_id"];
	$rv_id      = $row["rv_id"];
	$subject    = $row["subject"];
	$content    = $row["content"];

	$subject = "RE: ".$subject; 

	$content = "> ".$content; 
	$content = str_replace("\n", "\n>", $content);
	$content = "\n\n\n-----------------------------------------------\n".$content;

	$result2 = mysqli_query($con, "select name from members where id='$send_id'");
	$record = mysqli_fetch_array($result2);
	$send_name    = $record["name"];
?>		
	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?php echo $userid?>">
	    	<input type="hidden" name="rv_id" value="<?php echo $send_id?>">
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?php echo $userid?></span>
				</li>	
				<li>
					<span class="col1">수신 아이디 : </span>
					<span class="col2"><?php echo $send_name?>(<?php echo $send_id?>)</span>
				</li>	
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?php echo $subject?>"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">글 내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?php echo $content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	    <button id="send_btn" type="button" onclick="check_input()">보내기</button>
	    	</div>
	    </form>
	</div> <!-- message_box -->
</section> 
<footer>
   <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php";?>
</footer>
</body>
</html>
