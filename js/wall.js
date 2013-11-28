$(document).ready(function() 
{
$(".update_button").click(function() 
{
var PID = $(this).attr("id");
var updateval= $.trim($("#update"+PID).val());
var dataString = 'update='+ updateval+ '&post_id=' + PID;
if(updateval=='')
{
$(".update_button").attr("disabled", "disabled");
}
else
{
var ID = $(this).attr("id");
$('.update_button').css('opacity', '.5');
$(".update_button").html('Updating..');
$.ajax({
type: "POST",
url: "comments/message_ajax.php",
data: dataString,
cache: false,
success: function(response)
{
$(".update_button").html('Update');
$("#council").fadeIn().prepend($(response).fadeIn('slow'));
$(".wm").emotions();
$("#update"+PID).val('');
$("#upadte"+PID).focus(); 	
$('.update_button').css('opacity', '.5');
}
 });
}
return false;
});
$('.comment_button').live("click",function() 
{

var ID = $(this).attr("id");

var comment= $.trim($("#ctextarea"+ID).val());

var dataString = 'comment='+ comment + '&msg_id=' + ID;

if(comment=='')
{
$(".comment_button").attr("disabled", "disabled");
}
else
{
$('.comment_button').css('opacity', '.5');
$(".comment_button").html('Commenting..');
$.ajax({
type: "POST",
url: "comments/comment_ajax.php",
data: dataString,
cache: false,
success: function(response){

$(".comment_button").html('Post Comment');
$("#commentload"+ID).append($(response).fadeIn('slow'));
$(".Mi").emotions();
$("#ctextarea"+ID).val('');
$("#ctextarea"+ID).focus();
$('.comment_button').css('opacity', '.5');
}
 });
}
return false;
});

$('.commentopen').live("click",function() 
{
var ID = $(this).attr("id");
$("#commentbox"+ID).slideDown(0);
$("#baum"+ID).css('display','none');
return false;
});

$('.cancelbutton').live("click",function() 
{
var ID = $(this).attr("id").replace('cancel','');
$("#baum"+ID).css('display','');
$("#commentbox"+ID).slideUp(0);

return false;
});

$('.SlideOff').live("click", function(e){			
var pid = $(this).attr('id').replace('collapsed_','');			
//showLoader(this);
$('#loadComments'+pid).slideToggle('slow', function() {
									
//showExpand('#collapsed_'+pid);							
});	
});	

$('.clickOpen').live("click", function(e){

var pid = $(this).attr('id').replace('collapsed_','');	
var dataString = '&msg_id=' + pid;
$.ajax({
type: "POST",
url: "comments/collapsed_comm.php",
data: dataString,
cache: false,
success: function(response){						
$('#loadComments'+pid).append($(response).slideDown('slow'));
$(".Mi").emotions();
$('#collapsed_'+pid).removeClass('clickOpen').addClass('SlideOff');
}
});

});	
});
 $(document).ready(function(){
	 $(".Mi").emotions();
	 $(".wm").emotions();
});
function Clikethis( member_id, comment_id, action)
{
	if(!action)action=1;
	$('#clike-panel-'+comment_id).html('&nbsp;<img src="images/loader.gif"/>');

	$.post("comments/clikes.php?post_id="+comment_id+'&member_id='+member_id+'&action='+action, {
	 }, function(response){
		var response = $.trim(response);
		if(response > 0)
		{
			$('#ppl_clike_div_'+comment_id).show().css('display','inline');
			$('#clike-stats-'+comment_id).html('&hearts;'+response);
			
		}
		else if(response == 0)
		{
			$('#ppl_clike_div_'+comment_id).hide();
			$('#clike-stats-'+comment_id).html('&hearts;'+response);
		}
		
		if(action == 2)
		{
			$('#clike-panel-'+comment_id).html('&nbsp;<a href="javascript: void(0)" id="comment_id'+comment_id+'" onclick="javascript: Clikethis('+member_id+','+comment_id+', 1);">Like</a>');
		}
		else
		{
			$('#clike-panel-'+comment_id).html('&nbsp;<a href="javascript: void(0)" id="comment_id'+comment_id+'" class="Unlike" onclick="javascript: Clikethis('+member_id+','+comment_id+', 2);">Unlike</a>');
		}
	});
}	 
	 
function likethis( member_id, post_id, action)
	{
		if(!action)action=1;
			$('#loadera'+post_id).html('&nbsp;<img src="images/loader.gif"/>');
		$.post("comments/likes.php?member_id="+member_id+"&post_id="+post_id+'&action='+action, {
		}, function(response){
			var response = $.trim(response);
			if(response > 0)
			{
				$('#ppl_like_div_'+post_id).show();
				$('#like-stats-'+post_id).html('<b>&hearts;'+response+'</b>');
			}
			else if(response == 0)
			{
				$('#ppl_like_div_'+post_id).hide();
				$('#like-stats-'+post_id).html('<b>&hearts;'+response+'</b>');
			}
			
			if(action == 2)
			{
				$('#like-panel-'+post_id).html('&nbsp;<div id="po" href="javascript:void(0);" tabindex="0" role="button" class="esw eswd Hf Od" id="post_id'+post_id+'" onclick="javascript: likethis('+member_id+','+post_id+', 1);"><span class="sr ew" id="loadera'+post_id+'"></span></div>');
			}
			else
			{
				$('#like-panel-'+post_id).html('&nbsp;<div id="po" href="javascript:void(0);" tabindex="0" role="button" class="esw Hf Od eswa" id="post_id'+post_id+'" class="Unlike" onclick="javascript: likethis('+member_id+','+post_id+', 2);"><span class="sr ew" id="loadera'+post_id+'"></span></div>');
			}
		});
	}