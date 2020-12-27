<style>
.logo
{
max-width:100px;
max-height:100px;
}
</style>
<header>
<link rel ="stylesheet" href="/css/bar.css">
  <h1>🎄❄️☃️</h1>
<a href = "/index.php"><img class = "logo" src="/img/logo.jpg" alt="logo"></a>
  <nav>
  
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

<?php
    if(!$userid) {
?> 
    <a href = "/login_form.php"><span>로그인</span></a>
    <a href = "/member_form.php"><span>회원가입</span></a>
<?php
    } else {
                $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
?>
	<span><?php echo $logged ?></span>
<?php
                if($userlevel == 1) {
?>
	<a href = "/admin.php"><span>관리자모드</span></a>
<?php
                }
?>
   	<a href = "/logout.php"><span>로그아웃</span></a>
     <a href = "/member_modify_form.php"><span>정보수정</span></a>
	
<?php
    }
?>   
  </nav>
</header>
