<?php
$idx = $_GET["idx"];
$page = $_GET["page"];

$board_title = $_POST["board_title"];
$content = $_POST["content"];

//$conn =mysqli_connect("","","","");
$conn = mysqli_connect("","","","");
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

// board_table에서 해당 idx 값을 가진 것의 board_title을 새로운 board_title로 변경 
$sql = "UPDATE board_table SET board_title = '$board_title', content='$content'";
$sql .= " WHERE idx=$idx";
mysqli_query($conn, $sql);

mysqli_close($conn);

echo "
    <script>
        location.href = 'board_form.php?page=$page';
    </script>
";
?>