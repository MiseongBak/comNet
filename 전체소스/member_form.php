<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>회원 가입 페이지</title>
<link rel="stylesheet" type="text/css" href="./css/styles.css"> <!--*변경*-->
<link rel="stylesheet" type="text/css" href="./css/member.css">
<script>
	function check_input() //입력창에 데이터를 입력했는지 검사하는 함수
	{
		if (!document.member_form.id.value) { 
			alert("아이디를 입력하세요!");
			document.member_form.id.focus();
			return;
		} //아이디 입력 여부 검사

		if (!document.member_form.pass.value) {
			alert("비밀번호를 입력하세요!");
			document.member_form.pass.focus();
			return;
		} //비밀번호 입력 여부 검사

		if (!document.member_form.pass_confirm.value) {
			alert("비밀번호 확인을 입력하세요!");
			document.member_form.pass_confirm.focus();
			return;
		} //비밀번호 확인 입력 여부 검사
		
		if (!document.member_form.name.value) {
			alert("이름을 입력하세요!");
			document.member_form.name.focus();
			return;
		} //이름 입력 여부 검사

		if (!document.member_form.email1.value) {
			alert("이메일 주소를 입력하세요!");
			document.member_form.email1.focus();
			return;
		} //이메일 주소1 입력 여부 검사

		if (!document.member_form.email2.value) {
			alert("이메일 주소를 입력하세요!");
			document.member_form.email2.focus();
			return;
		} //이메일 주소2 입력 여부 검사

		if (document.member_form.pass.value != 
			document.member_form.pass_confirm.value) {
			alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
			document.member_form.pass.focus();
			document.member_form.pass.select();
			return;
		}

		document.member_form.submit();
	}

	function reset_form() { //'취소하기'를 눌렀을 시 초기화하는 함수
		document.member_form.id.value = "";
		document.member_form.pass.value = "";
		document.member_form.pass_confirm.value = "";
		document.member_form.name.value = "";
		document.member_form.email1.value = "";
		document.member_form.email2.value = "";
		document.member_form.id.focus();
		return;
	}

	function check_id() { //'중복확인'을 눌렀을 시 중복확인 창을 띄우는 함수
		window.open("member_check_id.php?id=" + document.member_form.id.value, "IDcheck", 
			"left=700, top=300, width=350, height=200, scrollbars=no, resizable=yes");
	}
</script>
</head>
<body>
	<header>
		<?php include "header.php";?>
	</header>
	<section>
		<div id="main_content">
			<div id="join_box">
				<form name="member_form" method="post" action="member_insert.php">
					<h2>회원 가입</h2>
					<div class="form id"> <!--아이디 입력창-->
						<div class="col1">아이디</div>
						<div class="col2">
							<input type="text" name="id">
						</div>
						<div class="col3">
							<a href="#"><img src="./img/check_id.gif" onclick="check_id()"></a>
						</div>
					</div>
					<div class="clear"></div>

					<div class="form"> <!--비밀번호 입력창-->
						<div class="col1">비밀번호</div>
						<div class="col2">
							<input type="password" name="pass">
						</div>
					</div>
					<div class="clear"></div>

					<div class="form"> <!--비밀번호 확인 입력창-->
						<div class="col1">비밀번호 확인</div>
						<div class="col2">
							<input type="password" name="pass_confirm">
						</div>
					</div>
					<div class="clear"></div>

					<div class="form"> <!--이름 입력창-->
						<div class="col1">이름</div>
						<div class="col2">
							<input type="text" name="name">
						</div>
					</div>
					<div class="clear"></div>

					<div class="form email"> <!--이메일 입력창-->
						<div class="col1">이메일</div>
						<div class="col2">
							<input type="text" name="email1">@<input type="text" name="email2">
						</div>
					</div>
					<div class="clear"></div>

					<div class="bottom_line"></div>
					<div class="buttons">
						<img id ="save_button" style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">&nbsp; <!--저장하기-->
						<img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif" onclick="reset_form()"> 
						<!--취소하기-->
					</div>
				</form>
			</div>
		</div>
	</section>
	<footer>
		<?php include "footer.php";?>
	</footer>
</body>
</html>