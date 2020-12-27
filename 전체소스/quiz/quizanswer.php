<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header>  
<?php
            //mysql 커넥션 객체 생성
            include "/quiz/quizdetail.php";
            
            $conn = mysqli_connect("", "", "", "");
            mysqli_query($conn, "set session character_set_connection=utf8;");
            mysqli_query($conn, "set session character_set_results=utf8;");
            mysqli_query($conn, "set session character_set_client=utf8;");
//            if($conn) {
//                echo "연결 성공<br>";
//            } else {
//                die("연결 실패 : " .mysqli_error());
//            }
            $answer = $_GET["answer"];
            $num = $_GET["num"];
//            echo $num."번째 글 내용<br>";
            $sql = "SELECT num, subject, content, regist_day ,answer FROM quizdatabase WHERE num = '".$num."'";
            $sql2 = "SELECT point FROM members WHERE id='$userid'";
            $result = mysqli_query($conn,$sql);
            $result2 = mysqli_query($conn,$sql2);
            $row = mysqli_fetch_array($result);
            $row2 = mysqli_fetch_array($result2);
            
            $user_point = $row2["point"];
            
        
             

        if($answer != $row["answer"])
        {
 
           echo("
              <script>
                window.alert('오답입니다')
                history.go(-1)
              </script>
           ");
        }
        else
        {
            $user_point = $user_point +1;
            $pass = 1;
            $sql3 = "UPDATE members SET point =$user_point where id='$userid'";
            mysqli_query($conn, $sql3);
            $sql4 = "insert into quiz_pass(quizid,userid,pass)";
            $sql4 .= "values($num, '$userid', $pass)";
            
            mysqli_query($conn, $sql3); 
            mysqli_query($conn, $sql4);  // $sql 에 저장된 명령 실행
            
            mysqli_close($conn);
            
              echo("
              <script>
                window.alert('정답입니다')
                location.replace('/quiz/quizlist.php');
              </script>
           ");
        }
?> 


    </body>
</html>
