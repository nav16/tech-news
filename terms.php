<?php
  include 'init.php';
include_once 'template/header.php';
?>
<title>Terms and Conditions | Tech News</title>

<style>
#box{
font-family:Verdana; font-size:9.5pt !important; 
}
</style>
<div id="sidebar">

	<a href="submit.php" class="button add-big">Submit Post URL</a>
			</div>
			<div id="box">
<b>What to Submit</b>
<br/><br/>
<p>
<b>On-Topic:</b> Anything that is relevant to the tech geeks. 
Moreover, make sure to submit only the latest news in technical world, latest technologies. 
<p>
<b>Off-Topic:</b> Most stories about programming, or css-tricks, or blogger, unless they're
evidence of some interesting new phenomenon. Videos of tricks
or hacks, or new services.
<p></div><br/>
<?
include 'tracker.php';
include_once 'template/footer.php';
?>