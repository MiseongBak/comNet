<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>쪽지 보내기</title>
<script>
  function check_input() {
  	  if (!document.message_form.rv_id.value)
      {
          alert("수신 아이디를 입력하세요!");
          document.message_form.rv_id.focus();
          return;
      }
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
	<link rel="stylesheet" type="text/css" href="/css/message_btn.css">
	<link rel="stylesheet" type="text/css" href="/css/message.css">
	<link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@700&display=swap" rel="stylesheet">

<style>

    #rv_btn , #sv_btn
    {
        border: solid 1px #000; 
        border-radius: 15px; 
        background-color:#000;
        text-align: center;
        color: #ffffff;
        height: 30px;
        width: 100px
    }

    input[type="text"] , textarea
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
<?php
	 if (!$userid )
	{
		echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	} 
?>
<section>
	<div id="main_img_bar">
        <img src="">
    </div>
   	<div id="message_box">
	    <h1 align="center">
	    		쪽지 보내기
		</h1>
		<br>
		<br>
		<hr>

		<ul class="top_buttons">
				<li><button id="rv_btn" onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button>
				<li><button id="sv_btn" onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button>
		</ul>
	    <form  name="message_form" method="post" action="/letter/message_insert.php?send_id=<?php echo $userid ?>">
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<span class="col1">보내는 사람</span>
					<span class="col2"><?php echo $userid ?></span>
				</li>	
				<li>
					<span class="col1">수신 아이디</span>
					<span class="col2"><input name="rv_id" type="text" placeholder="수신 아이디"></span>
				</li>	
	    		<li>
	    			<span class="col1">제목</span>
	    			<span class="col2"><input name="subject" type="text" placeholder="제목"></span>
	    		</li>		
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	    <button type="button" id="send_button" class="m_btn m_btn-1 m_btn-1a" onclick="check_input()">보내기</button>
	    	</div>	    	
	    </form>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</footer>
</body>
</html>
