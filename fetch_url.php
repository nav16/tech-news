<?php
$url = $_POST['url'];

function file_get_contents_curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $data = curl_exec($ch);
    $info = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    return $data;
}
//fetching url data via curl
$html = file_get_contents_curl($url);
if($html) {
    //parsing begins here
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');
    $title = $nodes->item(0)->nodeValue;
	$images = $doc->getElementsByTagName('img');
	$clean = false;
	echo '{"title":{
			"title":"'.$title.'"
			}';
	foreach($images as $img)
		{
			$url = $img->getAttribute('src');       
			$alt = $img->getAttribute('alt');
			$width = $img->getAttribute('width');
			$height = $img->getAttribute('height');				
			if($width > 200){
				echo ',"images":{
						"imgsrc":"'.$url.'",	
						"imgalt":"'.$alt.'"
					}';
					break;
			}else{
				echo ',"images":{
						"imgsrc":"",	
						"imgalt":""
					}';				
				
			}
	}
echo '}';
}
?>