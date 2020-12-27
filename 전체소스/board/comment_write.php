<?php
session_start();    // sesstion 아이디가 존재하는지 확인하고 없으면 새로운 아이디 생성
if (isset($_SESSION["userid"])) $userid = $_SESSTION["userid"];
else $userid = "";
if(isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";

$writer = $username;
$com_pw = $_POST['com_pw'];
$comment = $_POST['comment'];

?>

<body>
    Welcome<?php echo $writer;?><br>
    비밀번호<?php echo $com_pw;?><br>
    댓글 내용<?php echo $comment;?><br>
</body>