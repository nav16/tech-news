 <?php
  
 function datefor($date, $time)
 {
$days = floor($time / (60 * 60 * 24));
$remainder = $time % (60 * 60 * 24);
$hours = floor($remainder / (60 * 60));
$remainder = $remainder % (60 * 60);
$minutes = floor($remainder / 60);
$seconds = $remainder % 60;

if($days > 0) {
        $data = date('F d Y', $date);
		reset($date);
    }     
    elseif($days == 0 && $hours == 0 && $minutes == 0) {
        $data = "few seconds ago";
    }
    elseif($days == 0 && $hours == 0) {
        $data = $minutes.' minutes ago';
    }
    elseif($days == 0 && $hours > 0) {
        $data = $hours.' hour ago';
    }
    else {
        $data = "few seconds ago";
    }        

    return $data;
}

function isValidURL($url)
{
return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

?>