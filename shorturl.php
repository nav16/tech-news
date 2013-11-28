<?//This is the URL you want to shorten
$longUrl = $_GET['longUrl'];
$apiKey = 'AIzaSyAURtZdVCp-EOc6B1Sf9wcg2FJ_YFDA1S8';
//Get API key from : http://code.google.com/apis/console/
 
$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
$jsonData = json_encode($postData);
 
$curlObj = curl_init();
 
curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curlObj, CURLOPT_HEADER, 0);
curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
curl_setopt($curlObj, CURLOPT_POST, 1);
curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
 
$response = curl_exec($curlObj);
 
//change the response json string to object
$json = json_decode($response);
 
curl_close($curlObj);
 
echo '<div class="shortlink">
Wanna share? Here is your
<span id="handleer">shortlink:</span><span id="url"><input type="text" id="shorturl-link" value="'.$json->id.'" readonly="readonly" size="22px"/></span></div>';
?>
<script>
$(document).ready(function()
{
$("#shorturl-link").click(function(){
$(this).select();
});
});
</script>