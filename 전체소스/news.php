<html>
<head>
<style>

@import url('https://fonts.googleapis.com/css?family=Abel');


 #wrapper #pricing-tables .pricing-table {
	 width: 50%;
	 margin: auto;
}

 #wrapper #pricing-tables .pricing-table .header .title {
	 text-align: center;
	 text-transform: uppercase;
	 padding: 15px 0;
	 background: #e4e4e4;
	 color: #000;
	 font-size: 16px;
}
 #wrapper #pricing-tables .pricing-table .header .price {
	 text-align: center;
	 text-transform: uppercase;
	 padding: 15px 0;
	 background: #f6f6f6;
	 color: #000;
	 font-size: 28px;
	 font-weight: 300;
}
 #wrapper #pricing-tables .pricing-table .header .price span {
	 font-size: 14px;
	 vertical-align: super;
}
 #wrapper #pricing-tables .pricing-table .features {
	 background: #fff;
	 
}
 #wrapper #pricing-tables .pricing-table .features ul {
	 list-style: none;
	 margin: 0;
	 padding: 15px 0;
}
 #wrapper #pricing-tables .pricing-table .features ul li {
	 padding: 8px 5px;
	 text-align: center;
}
 #wrapper #pricing-tables .pricing-table .features ul li span {
	 color: #999;
}
 #wrapper #pricing-tables .pricing-table .signup {
	 background: #f6f6f6;
	 padding: 2px 0 25px 0;
	 width: 100%;
	 display: flex;
	 justify-content: center;
}
 #wrapper #pricing-tables .pricing-table .signup a {
	 width: auto;
	 margin: 0 auto;
	 padding: 8px 10px;
	 text-align: center;
	 text-decoration: none;
	 color: #fc4445;
	 border: 1px solid #000;
	 border-radius : 20px;
	 transition: all 0.2s ease;
	 
}

 #wrapper #pricing-tables .pricing-table.featured .header .title {
	 background: #000;
	 color: #fff;
}
 #wrapper #pricing-tables .pricing-table.featured .signup a {
	 background: #000;
	 color: #fff;
}
 #wrapper #pricing-tables .pricing-table.featured .signup a:hover {
	 color: #000;
	 background: #fff;
}
 


</style>
</head>
<body>
<header>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
</header> 
</header>
<?php

exec('python3 news.py');

$con = mysqli_connect("","","","");
mysqli_query($con, "set session character_set_connection=utf8;");
mysqli_query($con, "set session character_set_results=utf8;");
mysqli_query($con, "set session character_set_client=utf8;");

$sql = "select * from news";
$result = mysqli_query($con, $sql);

?>


<h1 align="center">최신 IT 뉴스 보기</h1>
<br>
<br>

<div id="wrapper">
  <div id="pricing-tables">
  <?php 
  $count = 0;
  while($row = mysqli_fetch_array($result)){
      $news_id    = $row["id"];
      $news_title = $row["title"];
      $news_link    = $row["link"];
      $news_img    = $row["img"];
     
      
  ?>
    <div class="pricing-table featured" style="border: 10px solid black; border-radius: 20px;">
      <div class="header">
        <div class="title"><?php echo "뉴스".strval($count=$count+1) ?></div>
        <div class="price"><img align="top" alt="이미지 없음" src='<?php echo $news_img ?>' width="150px" height="150px"> 
        <br>
        <?php echo $news_title ?></div>
      </div>
      <div class="signup">
        <a href='<?php echo $news_link ?>'>상세보기</a>
      </div>
    </div>
    
    <br>
    <br>
<?php 
  }
?>
   
    
  </div>
</div>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php";?>
</footer>
</body>
</html>