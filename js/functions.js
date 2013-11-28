function find(){
if (window.XMLHttpRequest) {
XMLHttpRequestObject = new XMLHttpRequest();
} else{
XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

XMLHttpRequestObject.onreadystatechange = function() 
{ 
if (XMLHttpRequestObject.readyState == 4 && 
XMLHttpRequestObject.status == 200) { 
document.getElementById('results').innerHTML = XMLHttpRequestObject.responseText ; 
}
}

XMLHttpRequestObject.open('GET', 'search.php?query='+document.search.query.value, true); 
XMLHttpRequestObject.send().slide();
}  

$(document).ready(function(){
$('#opshare').live("click",function() 
{
$(".getshare").fadeToggle('fast');
return false;
});	});


$(document).ready(function(){
$('.newsopen').live("click",function() 
{
$("#jome").slideDown('fast');
$("#gogo").css('display','none');
$(".Ng").slideDown('slow');
$('.news_button').css('opacity', '1');
return false;
});	

});
$(document).ready(function(){	
$(function(){
$(".msg").live("click",function(){
var ID = $(this).attr("id").replace('muni','');
$(".error-notification").slideUp();
});
});
});


$(document).ready(function(){	
$('#titl').bind('keyup', function() {
var a = $("#titl").val();
if(a != "")
{$('.post_button').css('opacity', '1');}else{$('.post_button').css('opacity', '.5');
}});
$('#link').bind('keyup', function() {
var a = $("#link").val();
if(a != "")
{$('.news_button').css('opacity', '1');}else{$('.news_button').css('opacity', '.5');
}});

$('.watermark').bind('keyup', function() { 
var a = $(".watermark").val();
if(a != "")
{$('.update_button').css('opacity', '1');}else{$('.update_button').css('opacity', '.5');}});

$('#username').bind('keyup', function() { 
var a = $("#username").val();
if(a != "")
{$('.login_button').css('opacity', '1');}else{$('.login_button').css('opacity', '.5');}});

$('#name').bind('keyup', function() { 
var a = $("#name").val();
if(a != "")
{$('.sign_button').css('opacity', '1');}else{$('.sign_button').css('opacity', '.5');}});
});	

$(document).ready(function(){	
$('.commareaa').bind('keyup', function() {
var PID = $(this).attr("id");
var updateval= $("#ctextarea"+PID).val();
var a = $("#ctextarea"+PID).val();
if(a != "")
{$('.comment_button').css('opacity', '1');}else{$('.comment_button').css('opacity', '.5');}});});	


$(document).ready(function()
{
$("#submit_form").submit(function()
{
$('.news_button').css('opacity', '.5');
$(".news_button").html('Submitting..');

$.post("submitact.php",{title:$('#title').val(),link:$('#link').val(),img_url:$('.stry').attr("src")} ,function(data)
{
$("#msagbox").fadeTo(200,0.1,function()  
{
if($.trim(data)=='yes') 
{
document.location='news.php';
}
else 
{
$('.news_button').css('opacity', '1');				  
$(this).addClass('messageboxerror').html(data).fadeTo(900,1);
$(".news_button").html('Submit Link');	
}
});	
});
return false;
//e.preventDefault();
});
});

$(document).ready(function()
{

$("#login_form").submit(function()
{
$('.login_button').css('opacity', '.5');
$(".login_button").html('Logging..');

$.post("ajax_login.php",{ username:$('#username').val(),password:$('#password').val()} ,function(data)
{
$("#msgbox").fadeTo(200,0.1,function()  
{
if($.trim(data)=='yes')
{				 
document.location= document.URL; 				
}
else 
{	
$('.login_button').css('opacity', '1');  
$(this).html(data).addClass('messageboxerror').fadeTo(900,1);
$(".login_button").html('Login');							
}
});	
});		
return false;
});
});

$(document).ready(function()
{
$("#register_form").submit(function()
{		
$('.sign_button').css('opacity', '.5');
$(".sign_button").html('Signing');		
$.post("registeract.php",{email:$('#email').val(),name:$('#name').val(),password:$('#pass').val(),mname:$('#mname').val()} ,function(data)
{
$("#msagbox").fadeTo(200,0.1,function()  
{
if($.trim(data)=='yes') 
{
document.location='news.php';
}
else 
{		
$('.sign_button').css('opacity', '1');  
$(this).html(data).addClass('messageboxerror').fadeTo(900,1);							
$(".sign_button").html('Sign Up');	
}
});	
});
return false;
//e.preventDefault();
});
});


$(document).ready(function()
{
$("#post_form").submit(function()
{
$('.post_button').css('opacity', '.5');
$(".post_button").html('Posting..');
	
$.post("postact.php",{titl:$('#titl').val(),conten:$('#conten').val()} ,function(data)
{
$("#mgbox").fadeTo(200,0.1,function()  
{
if($.trim(data)=='yes') 
{
document.location= document.URL;
}
else 
{			  
$(this).addClass('messageboxerror').html(data).fadeTo(900,1);
$(".post_button").html('Post');	
			
}
});	
});
return false;
//e.preventDefault();
});
});

 $(document).ready(function()
{
$("#conten").keyup(function()
{
var box=$(this).val();
var main = box.length *100;
var value= (main / 800);
var count= box.length;
$('#counta').html(count);
if(box.length <= 800)
{
$('#bara').animate(
{
"width": value+'%',
}, 1);
}
return false;
});
});
$(document).ready(function()
{
$(".sss").click(function()
{
var X=$(this).attr('id');

if(X==1)
{
$(".submenu").hide();
$(this).attr('id', '0');	
}
else
{

$(".submenu").show();
$(this).attr('id', '1');
}
	
});

//Mouseup textarea false
$(".submenu").mouseup(function()
{
return false
});
$(".sss").mouseup(function()
{
return false
});


//Textarea without editing.
$(document).mouseup(function()
{
$(".submenu").hide();
$(".sss").attr('id', '');
});
	
});

 
$('.buttons').live("click",function(){
var getID   =  $(this).attr('id').replace('button_','');
$('#button_').html('&nbsp;<img src="images/loader.gif"/>');
$.post("follow.php?id="+getID, {
}, function(response){
$('#button_'+getID).html($(response).fadeIn('slow'));
});});

$(document).ready(function()
{
  if($("#ExploreContainer .close.open").size()>=1){	var close = $("#ExploreContainer .close");
		close.parent().css("top",-close.parent().outerHeight(true) + close.outerHeight(true) + "px");
	  }  $("#ExploreContainer>.close").click(function(){var close = $(this);	
		if(!close.hasClass("open")){$(this).parent().animate({"top":(-close.parent().outerHeight(true) + close.outerHeight(true)+"px"),},500,function(){close.addClass("open");});}else{$(this).parent().animate({"top":20,},500,function(){close.removeClass("open");});} }); 
	
	$('#shorten-url').load(function(evt) {
		evt.preventDefault();
		if($('#long-url').length === 0 || $('#long-url').val() === '') {
			alert('You need to enter a URL to shorten.');
		} else {
			$.ajax({
				type: 'POST',
				url: 'shorturl.php',
				data: 'longUrl=' + $('#long-url').val(),
				success: function(data) {
					$('#shortened-url').html(data);
				}
			});
		} // end if/else
	});
});
