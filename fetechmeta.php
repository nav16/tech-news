<?php
//error_reporting(0);
$url = $_GET['url'];
$cnt =0;
function file_get_contents_curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    @curl_setopt($ch, CURLOPT_URL, $url);    
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
	$metas = $doc->getElementsByTagName('meta');
for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');}
$images = $doc->getElementsByTagName('img');
}

$is_video = 0;

include("video.php");

$embevi = new EmbeVi();
if($embevi->parseUrl($url)) {
$is_video = 1;
$embevi->setKeepRatio();
$embevi->setWidth(525);
$embevi->setHeight(0);
$video_info = $embevi->getEmbeddedInfo();
$video_provider = $embevi->getEmbeddedProvider();
$video = $embevi->getCode();
}
?>
<div class="info">
		<label class="desc">
			<?php  echo @$description; ?>
		</label>
<div class="inimg" style="clear:both;">
<div class="slider">
	<ul>
<?
if($is_video != 1){
foreach($images as $img)
{
$maxwidth = 525;
	$url = $img->getAttribute('src');       
	$alt = $img->getAttribute('alt');
$width = $img->getAttribute('width');
$height = $img->getAttribute('height');
/* $iSrcWidth = $width;
$iSrcHeight = $height;			
if($iSrcWidth > 525){
	$iFDefWidth = 525;
	$iWidth = $iHeight = $iFDefWidth;
	$iHeight = $iSrcHeight * $iWidth / $iSrcWidth;
	}else{
	$iFDefWidth = $iSrcWidth;
	$iWidth = $iHeight = $iSrcWidth;
	$iHeight = $iSrcHeight * $iWidth / $iFDefWidth;
} */


if($width > 200){ 	
	$cnt = $cnt + 1;
	echo '<li><img src="'.$url.'" title="'.$alt.'" width="525px"  height=""/></li>';
	}
}

?>
	</ul>
	</div>
	<?php 
	//echo $cnt;
	if($cnt > 1){
	?>
	<div id="slider-nav">
	<button role="button" class="nexu" data-dir="prev">&#9668;</button>
	<button role="button" class="nexu" data-dir="next">&#9658;</button>
    </div>
	<?}?>
	</div>
	<?
	}
		if($is_video > 0) {
		echo "<br clear=\"all\" /><br clear=\"all\" />";
		?>
		
		<div class="video" style="max-height:450px;">
			<?php  echo @$video; ?>
		</div>
		<?}?>
	</div>
	<script type="text/javascript" src="js/slider.js"></script>