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
        #board_box { width: 800px; margin: 0 auto 10px auto;}
        #board_box .title { margin-top: 30px; padding: 10px; border-bottom: solid 2px #516e7f; font-size: 20px; }
        #read_content li:nth-child(1) {	padding: 15px; border-bottom: solid 1px #aaaaaa; }
        #read_content .col2 { float: right; }
        #read_content li:nth-child(2) {	padding: 15px 15px 80px 15px; border-bottom: solid 1px #cccccc; }
        #read_content li:nth-child(3) button { padding: 5px 20px; margin: 15px 0 40px 720px; cursor: pointer; }
        #board_box .buttons {text-align: right;}
        #board_box .buttons li {display: inline; margin: 5px;}
        #board_read_form {width: 800px; margin: 0 auto; }
        #board_box .buttons li button {padding: 5px 10px; background-color: #000; color: #fff;}
    </style>
</head>
<body>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header> 
<section>
<div id="board_read_form">
    <div id="board_box">
        <h3 class="title">게시판 > 게시글 보기</h3>
<?php
    $idx = $_GET["idx"];
    $page = $_GET["page"];

    //$conn = mysqli_connect("","","","");
    $conn = mysqli_connect("","","","");
    mysqli_query($conn, "set session character_set_connection=utf8;");
    mysqli_query($conn, "set session character_set_results=utf8;");
    mysqli_query($conn, "set session character_set_client=utf8;");
    
    $sql = "SELECT * FROM board_table where idx=$idx";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
    $idx = $row["idx"];
    $board_title = $row["board_title"];
    $username = $row["username"];
    $id = $row["id"];
    $create_date = $row["create_date"];
    $click_count = $row["click_count"];
    $content = $row["content"];
    $file_name = $row["file_name"];
    $file_type = $row["file_type"];
    $file_copied = $row["file_copied"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);

    $new_click_count = $click_count + 1;
    $sql = "UPDATE board_table set click_count = $new_click_count where idx = $idx";
    mysqli_query($conn, $sql);
?>
        <ul id="read_content">
            <li>
                <span class="col1"><b>제목: </b> <?php echo $board_title?></span>
                <span class="col2"><?php echo $username?> | <?php echo $create_date?></span>
            </li>
            <li>
                <?php
                    if($file_name) {
                        $real_name = $file_copied;
                        $file_path = "./data/".$real_name;  // 파일 경로
                        $file_size = filesize($file_path);

                        echo "첨부파일: $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href='board_download.php?idx=$idx&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                    }
                ?>
                <?php echo $content?>
            </li>
        </ul>
        <ul class="buttons">
            <li><button onclick="location.href='board_form.php?page=<?php echo $page?>'">목록</button></li>
            <!-- userid(섹션) == id(db) 확인 -->
            <li>
<?php 
    
    if($id == $userid) { ?>

                <button onclick="location.href='board_modify_form.php?idx=<?php echo $idx?>&page=<?php echo $page?>'">수정</button>
<?php
    } else {
?>
                <a href="javascript:alert('작성자만 이용 가능합니다!')"><button>수정</button></a>
<?php
    }
?>
            </li>
            <li><button onclick="location.href='board_delete.php?idx=<?php echo $idx ?>&page=<?php echo $page?>'">삭제</button></li>
        </ul>
    </div>  
<br>
<br>
    <!-- 위까지 board_box -->
    <!-- 댓글 시작 disqus-->
    <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    this.language = "ko";
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://pystagram.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

</div>
<!-- board_read_form 끝 -->
</section>



<footer>
    <?php include "../footer.php";?>
</footer>
</body>
</html>