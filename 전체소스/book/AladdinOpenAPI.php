<?php
include('HTTPRequest.php');
include('AladdinXMLParser.php');
$url = 'http://www.aladdin.co.kr/ttb/api/ItemSearch.aspx';

$searchWord = $_GET['s']; 

$querySet = array(
	'ttbkey' => '<TTBKey Here>',
	'SearchTarget' => 'Book',
	'MaxResults' => '10',
	'start' => '1',
	'Query' => $searchWord,
	'output' => 'xml',
	'QueryType' => 'Title',
	'Version' => '20070901'
); 

$query = http_build_query($querySet);
$url = $url.'?'.$query;
$req = new HTTPRequest($url);
$body = $req->DownloadToString();

$errMsg = '';
$isError = strpos($body, "<error xml");

if ($isError){
	ereg ("\<errorMessage\>(.*)\<\/errorMessage", $body, $regs);
	$errMsg = $regs[0];
}  else {
	$xmlParser = new AladdinXMLParser();
	$parser = @xml_parser_create();
	if (!is_resource($parser)){
		die("PHP XML parser에러");
	} else {
			xml_set_object($parser, $xmlParser);
			xml_set_element_handler($parser, "startHandler", "endHandler");
			xml_set_character_data_handler($parser, "cdataHandler");
	}

	if (!xml_parse($parser, $body, true)) {
		printf("XML error: %s at line %d\n",
		xml_error_string(xml_get_error_code($parser)),
		xml_get_current_line_number($parser));
	}

	if (is_resource($parser)) {
		xml_parser_free($parser);
		unset( $parser );
	}
}
?> 
<html>
	<head>
		<title>aladdin - OpenAPI예제(php)</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />	
	</head>
	<body>
		<ul>
		<?php
			if($isError){
				echo "<li>에러메시지 : $errMsg</li>";
			} else {
				foreach($xmlParser->itemList as $item){
					echo '<li><b>'. $item['TITLE'] ."</b><br/>";
					echo str_replace('&', '&amp;', $item["LINK"]);
					echo '</li>';
				}
			}
		?>
		</ul>
	</body>
</html>
