<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>COM NET</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <style>
        * {padding: 0; margin: 0;}
        ul { list-style-type: none;}
        #board_box { position: relative; width: 800px; margin: 0 auto 10px auto;}
        #board_box h3 { margin-top: 30px;	padding: 10px; border-bottom: solid 2px #516e7f; font-size: 20px; }
        #board_form span { display: inline-block; }
        #board_form .col1 { width: 150px; }
        #board_form li {	padding: 12px; border-bottom: solid 1px #dddddd; }
        #board_form input { width: 500px; height: 25px; }
        #board_form textarea { width: 500px;	height: 150px; }
        #board_form #text_area {	position: relative;	height: 158px; }
        #board_form #text_area .col1 { position: absolute; top: 10px; }
        #board_form #text_area .col2 { position: absolute; left: 166px; }
        /* -margin: 20px 0 70px 0; */
        #board_box .buttons { text-align: right;}
        #board_box .buttons li { display: inline; margin: 5px;} 
        /* button -> li button  */
        #board_box .buttons li button { padding: 5px 10px; cursor: pointer; background-color: #000; color: #fff;}
    </style>
</head>
<body>
<header>
    <?php include "../header.php";?>
</header>

<section>
    <div id="board_box">
        <h3>게시판 > 새 글</h3>
        <form id="board_form" name="board_form" method="POST" action="board_write_result.php" enctype="multipart/form-data">
            <ul>
                <li>
                    <span class="col1">닉네임: </span>
                    <span class="col2"><?php echo $username?></span>
                </li>
                <li>
                    <span class="col1">제목: </span>
                    <span class="col2"><input name="board_title" type="text"></span>
                </li>
                <li id="text_area">
                    <span class="col1">내용: </span>
                    <span class="col2">
                        <textarea name="content"></textarea>
                    </span>
                </li>
                <li>
                    <span class="col1">첨부 파일</span>
                    <span class="col2"><input type="file" name="upfile"></span>
                </li>
            </ul>
            <ul class="buttons">
                <li><button type="button" onclick="check_input()">완료</button></li>
                <li><button type="button" onclick="location.href='board_form.php'">목록</button></li>
            </ul>
        </form>
    </div>
</section>
<footer>
    <?php include "../footer.php";?>
</footer>
<script>
    function check_input() {
        if (!document.board_form.board_title.value) {
            alert("제목을 입력하세요");
            document.board_form.board_title.focus();
            return;
        }
        if (!document.board_form.content.value) {
            alert("내용을 입력하세요");
            document.board_form.content.focus();
            return;
        }
        document.board_form.submit();
    }
</script>
</body>
</html>