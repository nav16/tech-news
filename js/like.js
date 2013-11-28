String.prototype.ltrim = function() {
	return this.replace(/^\s+/,"");
}
 function like_add(article_id){
var d = 'like'; 
	$.post("ajax/votes.php?action="+d+'&article_id='+article_id, {
	}, function(data){
		if($.trim(data) == 'true'){	
			total_votes(article_id);
		}else{
		total_false(article_id, data);
		}
	});
 }

//dislikes
  function dislike_add(article_id){
var d = 'dislike';
  $.post("ajax/votes.php?action="+d+'&article_id='+article_id, {
	
	}, function(data){
	if($.trim(data) == 'true'){
			total_votes(article_id);
		}else{
		  total_false(article_id, data);
		}
	
	});
 }
 
function total_votes(article_id){
var d = 'total'; 
	$.post("ajax/votes.php?action="+d+'&article_id='+article_id, {
	
	}, function(data){
		$('#article_'+article_id).html(data);
});
}
function total_false(article_id, data){
data1 = '<div class="error-notification" id="'+article_id+'" style="display: block; "><h2>'+data+'</h2><span class="close">(click on this box to dismiss)</span></div>';
$('#message_'+article_id).html(data1).slideDown();
}
