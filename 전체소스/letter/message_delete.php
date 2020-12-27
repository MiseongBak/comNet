<meta charset='utf-8'>

<?php

	$num = $_GET["num"];

	$mode = $_GET["mode"];

	include '../dbConnection.php';


	$sql = "delete from message where num=$num";

	mysqli_query($con, $sql);



	mysqli_close($con);                // DB 연결 끊기



	if($mode == "send")

		$url = "/letter/message_box.php?mode=send";

	else

		$url = "/letter/message_box.php?mode=rv";



	echo "

	<script>

		location.href = '$url';
	</script>

	";

?>

  
