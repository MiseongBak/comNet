<html>
<head>

<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/table_main.css">
	
<style type="text/css">

#paging{
    text-align: center;
}



</style>

<script type="text/javascript">


</script>

</head>

<?php


if (isset($_GET["page"]))
    $page = $_GET["page"];
    else
        $page = 1;
    
        
$PHP_SELP ="/emInfo/emInfoBoard.php";
$url = "http://openapi.work.go.kr/opi/opi/opia/wantedApi.do?authKey=authKey&callTp=L&returnType=XML&startPage=".$page."&display=10&occupation=024";
$ch = curl_init($url);

//응답 값을 브라우저에 보이지 않게함
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$xml = simplexml_load_string($response);

?>



<body>

<header>
     <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?> 
</header>

	<div class = "table" align="center"> 
		<div class = "row header">
			<div class="cell">
				제목
			</div>
			<div class="cell">
				회사
			</div>
			<div class="cell">
				연봉
			</div>
			<div class="cell">
				지역
			</div>
			<div class="cell">
				근무일
			</div>
			<div class="cell">
				학력
			</div>
			<div class="cell">
				경력
			</div>
		</div>
		
		<?php 
	
	
	for ($i=0 ; $i<10 ; $i++){ ?>
		
			<div class="row" onclick="location.href='<?php echo $xml->wanted[$i]->wantedInfoUrl ?>'">
		<div class="cell" data-title="회사">
		<?php echo $xml->wanted[$i]->title ?>
			
		</div>
		<div class="cell" data-title="제목">
			<?php echo $xml->wanted[$i]->company ?>
		</div>
		<div class="cell" data-title="연봉">
			<?php echo $xml->wanted[$i]->salTpNm."  ".$xml->wanted[$i]->sal ?>
		</div>
		<div class="cell" data-title="지역">
			<?php echo $xml->wanted[$i]->region ?>
		</div>
		<div class="cell" data-title="근무일">
			<?php echo $xml->wanted[$i]->holidayTpNm ?>
		</div>
		<div class="cell" data-title="학력">
			<?php echo $xml->wanted[$i]->minEdubg ?>
		</div>
		<div class="cell" data-title="경력">
			<?php echo $xml->wanted[$i]->career ?>
		</div>
	</div>
	
	<?php }?>
	
</div>
	
	
	<!-- 페이징 -->
	<br>
	
	<div id="paging">
	
	<a href="<?php echo $PHP_SELP?>?page=<?php echo $s_page-1 ?>">이전</a>
	
	<?php

	   $num = $xml->total;
	   $list = 10;
	   $block = 10;
	   
	   $pageNum = ceil($num/$list); // 총 페이지
	   $blockNum = ceil($pageNum/$block); // 총 블록
	   $nowBlock = ceil($page/$block);
	   
	   $s_page = ($nowBlock * $block) - ($block - 1);
	   
	   if ($s_page <= 1) {
	       $s_page = 1;
	   }
	   $e_page = $nowBlock*$block;
	   if ($pageNum <= $e_page) {
	       $e_page = $pageNum;
	   }
	   
	   
	   
	   for ($p=$s_page; $p<=$e_page; $p++) {
	       ?>

    <a href="<?php echo $PHP_SELP?>?page=<?php echo $p?>"><?php echo $p?></a>

<?php
}

?>
	
    
    <a href="<?php echo $PHP_SELP?>?page=<?php echo $e_page+1?>">다음</a>
</div>
<br>
<br>
 


	
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php";?> 
</footer>
</body>
</html>
