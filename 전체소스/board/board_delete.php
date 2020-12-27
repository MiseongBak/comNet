<?php

$idx = $_GET["idx"];
$page = $_GET["page"];


$conn = mysqli_connect("","","","");
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");

$sql = "SELECT * FROM board_table WHERE idx=$idx";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$copied_name = $row["file_copied"];

if ($copied_name) {
    $file_path = "./data/".$copied_name;    // data??
    unlink($file_path);
}

$sql = "DELETE FROM board_table WHERE idx=$idx";
mysqli_query($conn, $sql);
mysqli_close($conn);


echo "
    <script>
        location.href='board_form.php?page=$page';
    </script>
";
?>