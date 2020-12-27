<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>회원 정보 수정 페이지</title>
	<link rel="stylesheet" type="text/css" href="./css/styles.css">
	<link rel="stylesheet" type="text/css" href="./css/member.css">
	<script type="text/javascript" src="./js/member_modify.js"></script>
</head>
<body>
	<header>
		<?php include "./header.php";?>
	</header>
<?php
	include "./dbConnection.php";
	$sql = "select * from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$pass = $row["pass"];
	$name = $row["name"];

	$email = explode("@", $row["email"]);
	$email1 = $email[0];
	$email2 = $email[1];

	mysqli_close($con);
?>
	<section>
		<div id="main_content">
			<div id="join_box">
				<form name="member_form" method="post" action="./member_modify.php?id=<?php echo $userid ?>">
					<h2>회원 정보 수정</h2>
					<div class="form id">
						<div class="col1">아이디</div>
						<div class="col2">
							<?php echo $userid ?>
						</div>
					</div>
					<div class="clear"></div>

					<div class="form">
						<div class="col1">비밀번호</div>
						<div class="col2">
							<input type="password" name="pass" value="<?php echo $pass?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="form">
						<div class="col1">비밀번호 확인</div>
						<div class="col2">
							<input type="password" name="pass_confirm" value="<?php echo $pass?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="form">
						<div class="col1">이름</div>
						<div class="col2">
							<input type="text" name="name" value="<?php echo $name?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="form email">
						<div class="col1">이메일</div>
						<div class="col2">
							<input type="text" name="email1" value="<?php echo $email1?>">@<input type="text" name="email2" value="<?php echo $email2?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="bottom_line"></div>
					<div class="buttons">
						<img id ="save_button" style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">&nbsp;
						<img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif" onclick="reset_form()">
					</div>
				</form>
			</div>
		</div>
	</section>
	<footer>
		<?php include "./footer.php";?>
	</footer>
</body>
</html>