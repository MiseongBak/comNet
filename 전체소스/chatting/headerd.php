<html>
<head>
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="./js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<link rel="stylesheet" type="text/css" href="/css/footer.css">
	<link rel="stylesheet" type="text/css" href="/css/message.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	
   <style>
	img { display: block; margin: 0px auto; }
    	.logo {
	   width: auto; height: auto;
	   max-width: 500px;
	   max-height: 500px;
	}
   </style>
</head>

<body>
	<a href= "/index.php">
	<img class="logo" src="/img/logo.png" alt="logo"></a>

</body>
</html>

<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>		
        <div id="top">
            <ul id="top_menu">  
<?php
    if(!$userid) {
?>                

                <li><a href="member_form.php">회원 가입</a> </li>
                <li> | </li>
                <li><a href="login_form.php">로그인</a></li>
<?php
    } else {
                $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
?>
                <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="logout.php">로그아웃</a> </li>
                <li> | </li>
<?php
    }
?>      
            </ul>
        </div>    
        <div id="cssmenu">
            <ul> 
                <li><a href="/index.php">HOME</a></li>  
                <li><a href="/letter/message_form.php"?>쪽지</a></li>                            
                <li><a href="">채팅</a></li>
                <li><a href="">정보수정</a></li>
                <li><a href="">취업정보</a></li>
                <li><a href="">게시판</a></li>
                <li><a href="">휴식</a></li>
            </ul>
        </div>