<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];

    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

              
   include "./dbConnection.php";
    mysqli_query($con, "set session character_set_connection=utf8;");
    mysqli_query($con, "set session character_set_results=utf8;");
    mysqli_query($con, "set session character_set_client=utf8;");
    
    
	$sql = "insert into members(id, pass, name, email, regist_day, level, point)";
	$sql .= "values('$id', '$pass', '$name', '$email', '$regist_day', 9, 0)";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
