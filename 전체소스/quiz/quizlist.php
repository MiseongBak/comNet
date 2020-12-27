<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>퀴즈게시판</title>
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
        </style>
    </head>
    <body>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header>  

        <h1 class="display-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;퀴즈게시판</h1>
        
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
        
        <?php
            $currentPage = 1;
            
            if (isset($_GET["currentPage"])) {
                $currentPage = $_GET["currentPage"];
            }

            //mysqli_connect()함수로 커넥션 객체 생성
            $con = mysqli_connect("", "", "", "");
        	mysqli_query($con, "set session character_set_connection=utf8;");
    	    mysqli_query($con, "set session character_set_results=utf8;");
           	mysqli_query($con, "set session character_set_client=utf8;");

            //커넥션 객체 생성 확인
//            if($con) {
//               echo "연결 성공<br>";
//            } else {
//                die("연결 실패 : " .mysqli_error());
//            }
            
            //페이징 작업을 위한 테이블 내 전체 행 갯수 조회 쿼리
            $sqlCount = "SELECT count(*) FROM quizdatabase";
            $resultCount = mysqli_query($con,$sqlCount);
            $sqlSolCnt = "SELECT count(*) FROM quiz_pass WHERE userid = '$userid'";
            $resultSolCnt = mysqli_query($con,$sqlSolCnt);
            $rowCount = mysqli_fetch_array($resultCount);
            $rowSolCnt = mysqli_fetch_array($resultSolCnt);
            if ($rowCount) {
                $totalRowNum = $rowCount["count(*)"]-$rowSolCnt["count(*)"];   //php는 지역 변수를 밖에서 사용 가능.
            }
            //행 갯수 조회 쿼리가 실행 됐는지 여부
//            if($resultCount) {
//              echo "행 갯수 조회 성공 : ". $totalRowNum."<br>";
//            } else {
//                echo "결과 없음: ".mysqli_error($con)."<br>";
//            }
                        
            $rowPerPage = 5;   //페이지당 보여줄 게시물 행의 수
            $begin = ($currentPage -1) * $rowPerPage;
            //board 테이블을 조회해서 board_no, board_title, board_user, board_date 필드 값을 내림차순으로 정렬하여 모두 가져 오는 쿼리
            //입력된 begin값과 rowPerPage 값에 따라 가져오는 행의 시작과 갯수가 달라지는 쿼리
            //$sql = "SELECT num, subject, content, regist_day FROM quizdatabase order by num asc limit ".$begin.",".$rowPerPage."";
            $sql= "select * from quizdatabase where num not in
(select quizdatabase.num from quizdatabase,quiz_pass where quiz_pass.quizid = quizdatabase.num and quiz_pass.userid = '$userid')  order by num asc limit ".$begin.",".$rowPerPage."";
            $result = mysqli_query($con,$sql);
            
//            echo $sql;
            
            //쿼리 조회 결과가 있는지 확인
//            if($result) {
//                echo "조회 성공";
//            } else {
//                echo "결과 없음: ".mysqli_error($con);
//            }
        ?>
        <table style="width:80%" class="table table-bordered">
            <tr>
                <td style="width:5%; text-align:center">번호</td>
                <td style="width:70%">제목</td>
                <td style="width:5%; text-align:center">작성일</td>
            </tr>
            <?php
                //반복문을 이용하여 result 변수에 담긴 값을 row변수에 계속 담아서 row변수의 값을 테이블에 출력한다.
                while($row = mysqli_fetch_array($result)){ 
            ?>
                <tr>
                    <td style="width:5%; text-align:center">
                        <?php
                            echo $row["num"];
                        ?>
                    </td>
                    <td style="width:70%">
                        <?php
                            echo "<a href='/quiz/quizdetail.php?num=".$row["num"]."'>";
                            echo $row["subject"];
                            echo "</a>";
                        ?>
                    </td>
                    <td style="width:5%; text-align:center">
                        <?php
                           echo $row["regist_day"];
                        ?>
                    </td>
                </tr>
            <?php
                }
            ?>
        </table>
        <h1> </h1>
        &nbsp;&nbsp;&nbsp;&nbsp;       
        <?php
            //currentPage 변수가 1보다 클때만 이전 버튼이 활성화 되도록 함
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if($currentPage > 1 ) { 
                //이전 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 뺀 값이 넘어가도록 함
                echo "<a class='button' href ='/quiz/quizlist.php?currentPage=".($currentPage-1)."'>&nbsp;이전&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
 
            $lastPage = ($totalRowNum - ($totalRowNum % $rowPerPage)) / $rowPerPage;
            if (($totalRowNum) % $rowPerPage != 0) { 
                $lastPage = $lastPage + 1;
            }
            //lastPage변수가 currentPage 변수보다 클때만 다음 버튼이 활성화 되도록 함
            if($currentPage < $lastPage) { 
                //다음 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 더한 값이 넘어가도록 함
                echo "<a class='button' href='/quiz/quizlist.php?currentPage=".($currentPage+1)."'>&nbsp;다음&nbsp;</a>";
            }
            mysqli_close($con);
        ?>
        &nbsp;&nbsp;
        <br><br><br><br><br>
        <script type="text/javascript" src="js/bootstrap.js"></script>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
</footer>
    </body>
</html>

