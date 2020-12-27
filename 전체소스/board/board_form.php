<!DOCTYPE html>
<html>
<head>
    <title>COM NET</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <style>
        * {padding: 0; margin: 0;}
        ul { list-style-type: none;}
        #board_list li { padding: 10px 0; border-bottom: solid 1px #dddddd; }
        #board_list span { display: inline-block; text-align: center;}
        #board_list .col1 { width: 80px; }
        #board_list .col2 { width: 330px; text-align: left; }
        #board_list .col3 { width: 100px; }
        #board_list .col4 { width: 40px; }
        #board_list .col5 { width: 180px; }
        #board_list .col6 { width: 40px; }
        #page_num {	text-align: center;	margin: 30px 0 }
        #page_num li { display: inline; }
        #board_box {width: 800px; margin: 0 auto 10px auto;}
        #board_box .buttons {text-align: right;}
        #board_box .buttons li {display: inline; margin: 5px;}
        #board_box .buttons li button {padding: 5px 10px; background-color: #000; color: #fff;}
    </style>
</head>
<body>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header> 
<section>
    <div id="board_box">
        <h3>게시판 > 목록보기</h3>
        <ul id="board_list">
            <li>
                <span class="col1">번호</span> 
                <span class="col2">제목</span> 
                <span class="col3">닉네임</span> 
                <span class="col4">첨부</span> 
                <span class="col5">작성일</span> 
                <span class="col6">조회</span>
            </li>

<?php
    if(isset($_GET["page"])) {  //isset: 변수에 값이 할당됐는지 파악
        $page = $_GET["page"];  // 할당o
    } else {
        $page = 1;      // 할당x
    }

    //$conn = mysqli_connect("","","","");
    $conn = mysqli_connect("","","","");
    mysqli_query($conn, "set session character_set_connection=utf8;");
    mysqli_query($conn, "set session character_set_results=utf8;");
    mysqli_query($conn, "set session character_set_client=utf8;");

    $sql = "SELECT * FROM board_table";
    $result = mysqli_query($conn, $sql);
    $total_instance = mysqli_num_rows($result);   // 가져온 query의 행 정보(record == instance), 즉 전체 글 수
    $scale = 10;    // 게시글 10개당 1 page

    // 전체 페이지 수 계산
    if ($total_instance % $scale == 0) {
        $total_page = floor($total_instance/$scale);    //floor: 소수점 아래 버림
    } else {
        $total_page = floor($total_instance/$scale) + 1;
    }

    $start = ($page - 1) * $scale;     
    $number = $total_instance - $start;

    for($i = $start; $i < $start + $scale && $i < $total_instance; $i++) {
        mysqli_data_seek($result, $i);  //result에서 $i번째 instance를 선택
        $row = mysqli_fetch_array($result); // result에서 instance 1개씩 리턴

        $idx = $row["idx"];
        $board_title = $row["board_title"];
        $username = $row["username"];
        $id = $row["id"];
        $create_date = $row["create_date"];
        $click_count = $row["click_count"];

        if($row["file_name"]) { // 첨부 파일이 있으면 이미지 띄우기
            $file_image = "<img src='./file.gif' alt='' />";
        }  else {
            $file_image = " ";
        }
?>
            <li>
                <span class="col1"><?php echo $number?></span>
                <span class="col2"><a href="board_read.php?idx=<?php echo $idx ?>&page=<?php echo $page?>"><?php echo $board_title?></a></span>
                <span class="col3"><?php echo $username?></span>
                <span class="col4"><?php echo $file_image?></span>
                <span class="col5"><?php echo $create_date?></span>
                <span class="col6"><?php echo $click_count?></span>
            </li>
<?php
        $number--;
    }   // for문 종료
    mysqli_close($conn);
?>
        </ul>
        <ul id="page_num">

<?php
    // <이전>
    if($total_page >= 2 && $page >= 2) {
        $new_page = $page - 1;  // 페이지가 늘 때마다 처음 만들어진 페이지는 뒤로 간다
        echo "<li><a href='board_form.php?page=$new_page'> 이전</a></li>";
    } else {
        echo "<li>&nbsp;</li>";
    }

    // 페이지 링크 번호, <현재>
    for ($i = 1; $i <= $total_page; $i++) {
        if ($page == $i) {      // 현재 페이지의 번호는 링크x
            echo "<li><b> $i </b></li>";
        } else {
            echo "<li><a href='board_form.php?page=$i'> $i </a></li>";
        }
    }
    // <다음>
    if ($total_page >= 2 && $page != $total_page) {
        $new_page = $page + 1;
        echo "<li><a href='board_form.php?page=$new_page'> 다음 </a></li>";
    } else {
        echo "<li>&nbsp</li>";
    }
?>
        </ul>  
        <ul class="buttons">
            <li><button onclick="location.href='board_form.php'">목록</button></li>
            <li>
<?php
    if($userid) { // $userid: 로그인 확인
?>
                <button onclick="location.href='board_write_form.php'">+ 새 글</=></button>
<?php
    } else {
?>
                <a href="javascript:alert('로그인 후 이용 가능합니다')"><button>+ 새 글</button></a>
<?php
    }
?>
            </li>
        </ul>
    </div>
</section>

<footer>
    <?php include "../footer.php";?>
</footer>
</body>
</html>
