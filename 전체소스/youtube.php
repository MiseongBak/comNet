<html>
<head>

<style type="text/css">
    input[type="text"] { 
    border: solid 1px #000; 
    border-radius: 10px; 
    background-color:#000; 
    height: 40px; 
    width: 250px;
    text-align: center;
    color: #ffffff;
    }
    
    
    #search_btn{ 
    border: solid 1px #000; 
    border-radius: 15px; 
    background-color:#000;
    text-align: center;
    color: #ffffff;
    height: 30px;
    width: 40px
    }

</style>

<script type="text/javascript">

window.onload = function(){

	chageLangSelect()
	keyword_clear()
}

function chageLangSelect(){

	
	var selects = document.getElementById("keyword_sel");
    var text_keyword = document.getElementById("text_keyword");
    
    // select element에서 선택된 option의 value가 저장된다.
    var selectValue = selects.options[document.getElementById("keyword_sel").selectedIndex].value;
    
    text_keyword.value = selectValue;
}

function keyword_clear(){
	var text_keyword = document.getElementById("text_keyword");
	text_keyword.value="";
	
}

</script>

<link rel="stylesheet" type="text/css" href="/css/news_table.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>

<?php
// 네이버 뉴스 검색 API
    
    $query=$_POST["keyWord"];
    if(!isset($query)){
        $query="경상대";    
    }
    
    $sort="date";
    $display=5;
    $start=0;
    $api_url = "";
    $client_id = "key값";
    $client_secret = "U2yhPXWQlo";
 
    // 요청 URL
    $api_url.= "https://openapi.naver.com/v1/search/news.json"; // 뉴스 검색 결과 json
    // $api_url .= "https://openapi.naver.com/v1/search/news.xml"; // 뉴스 검색 결과 xml
    
    // 검색어, 필수 입력
    $api_url .= "?query=".urlencode($query);
 
    // 정렬, sim (정확도순) or date(최신순). 없으면 default 값인 sim 으로 적용됨
    if($sort != "")
        $api_url .= "&sort=".$sort;
 
    // 검색 시작 위치, 없으면 기본값
    if($start > 0)
        $api_url .= "&start=".$start;
 
    // 한 페이지에 보여줄 개수, 없으면 기본값
    if($display > 0)
        $api_url .= "&display=".$display;
 
    $ch = curl_init();
    $ch_headers[] = "X-Naver-Client-Id: ".$client_id;
    $ch_headers[] = "X-Naver-Client-Secret: ".$client_secret;
    $headers[] = "X-Naver-Client-Secret: ".$client_secret;
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $ch_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    $result =  json_decode($response);
    curl_close($ch);
    
    $re_array= array();
    
 
?>
<body>
  
<header>
     <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?> 
</header>


<!-- 유튜브 영상 부분  -->

<?php

$apiKey = '키값';
$q=$_POST["keyWord"];

if(!isset($q)){
    $q="경상대";
}
//공백제거(유튜브 검색시 공백이 존재하면 에러)
$q=preg_replace("/\s+/", "", $q);


function get_content($URL){
    $y_ch = curl_init();
    curl_setopt($y_ch, CURLOPT_HEADER, 0);
    curl_setopt($y_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($y_ch, CURLOPT_URL, $URL);
    curl_setopt($y_ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($y_ch, CURLOPT_VERBOSE, 0);
    curl_setopt($y_ch, CURLOPT_SSL_VERIFYPEER, false);
    $y_response = curl_exec($y_ch);
    curl_close($y_ch);
    return $y_response;
}
$y_re = get_content('https://www.googleapis.com/youtube/v3/search?q='.$q.'&key='.$apiKey.'&type=video');

$y_data = json_decode($y_re);
$y_result = array();

$y_result[0] = $y_data->items[0]->id->videoId;
$y_result[1] = $y_data->items[1]->id->videoId;


/* for($i=0; $i<=5; $i=$i+1)
{
        array_push($result,$data->items[$i]->id->videoId );
} */

?>

<div id="y_title" align="center"><h1>영상</h1></div>
<div align="center">
<form method="POST" action="youtube.php">
	
	<!-- 콤보박스 -->
	<select id="keyword_sel" onchange="chageLangSelect()" style="color: #fff;background: #000; width: 130px;height:40px;border:1px solid;border-radius:10px;align:center">
          <option value = "웹프로그래밍" selected>웹프로그래밍</option>
          <option value = "자바스크립트">자바스크립트</option>
          <option value = "HTML">HTML</option>
          <option value = "파이썬">파이썬</option>
          <option value = "자료구조">자료구조</option>
          <option value = "컴공알고리즘">알고리즘</option>
       </select>	

	<!-- 키워드 -->
   <input type="text" name="keyWord" id="text_keyword" placeholder="키워드를 입력하세요" onclick="keyword_clear()">
  <button type="submit" id="search_btn">  <i class="fas fa-search"></i>  </button><br/>
 
</div>  
  	<div align="center">
	<div id="player"></div>
	<div id="player2"></div>
  	</div>

        <script>
            // 2. This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement('script');

            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // 3. This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;
            var player2;
            
            function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '260',
                width: '540',
                videoId: '<?php echo $y_result[0];?>' ,
                events: {
                    'onStateChange': onPlayerStateChange
                    }
                });

            player2 = new YT.Player('player2', {
                height: '260',
                width: '540',
                videoId: '<?php echo $y_result[1];?>' ,
                events: {
                    'onStateChange': onPlayerStateChange
                    }
                });
            }

          // 4. The API will call this function when the video player is ready.
          function onPlayerReady(event) {
              event.target.playVideo();
          }

          // 5. The API calls this function when the player's state changes.
          //    The function indicates that when playing a video (state=1),
          //    the player should play for six seconds and then stop.
          var done = false;
          function onPlayerStateChange(event) {
              if (event.data == YT.PlayerState.PLAYING && !done) {
                  setTimeout(stopVideo, 6000);
                  done = true;
              }
          }
          function stopVideo() {
              player.stopVideo();
          }
    </script>





<!-- 기사 뉴스 테이블  -->
<br>
<br>
<br>
<br>
<br>
<br>
<hr>

<div id="title" align="center"><h1>뉴스</h1></div>

	<div class = "table">
		<div class = "row header">
			<div class="cell" align="center">
				제목
			</div>
			<div class="cell"  align="center">
				날짜
			</div>
			<div class="cell"  align="center">
				내용
			</div>
		</div>


<?php 
for($i=0; $i<5; $i++){ ?>
		<div class="row" onclick="location.href='<?php echo $result->items[$i]->link ?>'">
        	<div class="cell" data-title="제목">
        	<?php echo $result->items[$i]->title ?>
        	</div>
        
        	<div class="cell" data-title="날짜">
       		 <?php echo $result->items[$i]->pubDate ?>
        	</div>
        
            <div class="cell" data-title="내용">
            <?php echo $result->items[$i]->description ?>
            </div>
         </div>   
<?php  } ?>   
</div>
<br>
<br>
<br>

<footer>
    <?php include $_SERVER['DOCUMENT_ROOT']."/footer.php";?> 
</footer>

</body>
</html>

