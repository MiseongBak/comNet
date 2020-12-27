</<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <style>
            table {
                border: 1px solid;
                border-collapse:collapse;
                table-layout: fixed;
                margin: auto;
                word-wrap: break-word;
            }
            td {
                border: 1px solid;
                border-collapse:collapse;
                padding : 5px;
            }
            a.button{
                -webkit-appearance: button;
                -moz-appearance: button;
                appearance: button;
                
                text-decoration: none;
                border: 1px solid;
                border-radius: 5px;
                padding: 5px 10px;
                background-color: black;
                color: white;
            }
            form {
                margin-left: 135px;
            }
        </style>
    </head>
    <body>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>

   
</header>  
        <h1 class="display-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;퀴즈게시판</h1>
        <?php
            //mysql 커넥션 객체 생성
            $con = mysqli_connect("", "", "", "");
	        mysqli_query($con, "set session character_set_connection=utf8;");
  	          mysqli_query($con, "set session character_set_results=utf8;");
   	         mysqli_query($con, "set session character_set_client=utf8;");

            //커넥션 객체 생성 여부 확인
//            if($conn) {
//                echo "연결 성공<br>";
//            } else {
//                die("연결 실패 : " .mysqli_error());
//            }

            $num = $_GET["num"];
//            echo $num."번째 글 내용<br>";

            $sql = "SELECT num, subject, content, regist_day FROM quizdatabase WHERE num = '".$num."'";
            $result = mysqli_query($con,$sql);
            //조회 성공 여부 확인
//            if($result) {
//                echo "조회 성공";
//            } else {
//                echo "결과 없음: ".mysqli_error($conn);
//            }
        ?>
        <table class="table table-bordered" style="width:80%" >
            <?php
                //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
                $row = mysqli_fetch_array($result);
                if($row) {
            ?>

            <tr>
                <td style="width:10%">글 제목</td>
                <td style="width:35%">
                    <?php
                        echo $row["subject"];
                    ?>
                </td>
                <td style="width:10%">글 번호</td>
                <td style="width:5%">
                        <?php
                            echo $row["num"];
                        ?>
                </td>
                <td style="width:10%">작성 일자</td>
                <td style="width:10%">
                    <?php
                        echo $row["regist_day"];
                    ?>
                </td>
                
            </tr>
            <tr>
                <td colspan="6">
                    <?php
                        echo $row["content"];
                    ?>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
        <br>

        <form method="get" action='/quiz/quizanswer.php'>
        <input type="text" name="answer"/>
        <input type="hidden" name ="num" value = <?php echo $row["num"]; ?>>
        <input type="submit" value="제출하기"/><br>
        </form>                            



        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class='button' href="/quiz/quizlist.php">&nbsp;목록&nbsp;</a>
        <script type="text/javascript" src="js/bootstrap.js"></script>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</footer>
    </body>
</html>