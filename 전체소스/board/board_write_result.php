<header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header>  

<meta charset="utf-8">
<?php
// session_start();    // sesstion 아이디가 존재하는지 확인하고 없으면 새로운 아이디 생성
// if (isset($_SESSION["userid"])) $userid = $_SESSTION["userid"];
// else $userid = "";
// if(isset($_SESSION["username"])) $username = $_SESSION["username"];
// else $username = "";

if (!$userid) {
    echo("
        <script>
        alert('게시판 글쓰기는 로그인 후 이용 가능!');
        history.go(-1)
        </script>
    ");
        exit;
}

$board_title = $_POST["board_title"];
$content = $_POST["content"];

// htmlspecialchars(문자열 반환, 문자열 아닐 시 수행)
$board_title = htmlspecialchars($board_title, ENT_QUOTES);
$content = htmlspecialchars($content, ENT_QUOTES);

$create_date = date("Y-m-d (H:i)");

$upload_dir = $_SERVER['DOCUMENT_ROOT']."/data/"; 


$upfile_name = $_FILES["upfile"]["name"];
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];   //서버가 업로드 받은 파일 변수
$upfile_type = $_FILES["upfile"]["type"];
$upfile_size = $_FILES["upfile"]["size"];
$upfile_error = $_FILES["upfile"]["error"];


if ($upfile_name && !$upfile_error) {
    $file = explode(".", $upfile_name); // 문자열을 분할해서 배열로 저장
    $file_name = $file[0];
    $file_ext = $file[1];

    $new_file_name = date("Y_m_i_H_i_s");
    $new_file_name = $new_file_name;
    $copied_file_name = $new_file_name.".".$file_ext;
    $uploaded_file = $upload_dir.$copied_file_name; // $uploaded_file: 저장될 위치
   
    
    if ($upfile_size > 10000000) {
        echo("
            <script>
            alert('업로드 파일 크기가 지정된 용량(10MB)을 초과했습니다');
            history.go(-1)
            </script>
        ");
            exit;
    }
    // 서버로 전송된 파일이 저장되지 않았을 경우
    if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {

        echo("
            <script>
            alert('파일을 지정한 디렉토리에 복사하는데 실패');
            history.go(-1)
            </script>
        ");
        exit;

    }
} else {
    $upfile_name = "";
    $upfile_type = "";
    $copied_file_name = "";
}

//$con = mysqli_connect("","","","");
$con = mysqli_connect("","","","");
mysqli_query($con, "set session character_set_connection=utf8;");
mysqli_query($con, "set session character_set_results=utf8;");
mysqli_query($con, "set session character_set_client=utf8;");

/*
insert into TABLENAME : 테이블에 데이터 입력
values(테이블에 넣을 데이터 리스트)
*/


$sql = "INSERT into board_table(board_title, username, id, create_date, click_count, content, file_name, file_type, file_copied) ";
$sql .= "values('$board_title', '$username', '$userid', '$create_date', 0, '$content', ";
$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
mysqli_query($con, $sql);  // $sql에 저장된 명령 실행

$point_up = 100;

$sql = "SELECT point from members where id='$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$new_point = $row["point"] + $point_up;

$sql = "UPDATE members set point = $new_point where id='$userid'";
mysqli_query($con, $sql);

mysqli_close($con);

echo "
    <script>
    location.href='/board/board_form.php';
    </script>
";

?>