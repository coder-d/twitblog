<div class="add_comment" id="add_comment">
<?if(isset($this->comment_error)){?>
	<div class="error"><?=$this->comment_error;?></div><?}?>
<form action="<?php echo URL; ?>post/add_comment/" method="post" id="comment_form" onsubmit="comment_data();return false;">

  <fieldset>
	   <legend>Add Comment</legend>
   
			 
		 <div>
		    <label> </label>
		    <textarea cols="60" name="comment[body]" id="comment_textarea" rows="20"></textarea>
		    <input type="hidden" name="comment[post_id]" value="<?=$this->result['post_id'];?>">
	  
		 </div>
		 <div id="comment_textareadiv" style="font-size:10px"></div>
		  
	 
		  <input type="submit" id="submit_post" value="Add Comment" />

	 </fieldset>

</form>

<script type="text/javascript">
function comment_data(){
   var formData = $('#comment_form').serialize();
   $.ajax({
       url: '<?php echo URL; ?>post/add_comment/',
       type: 'post',
       data: formData,
       success:function (data, textStatus) {$("#comment_section").html(data);}
       //success: function(response){
         //  alert('success');
       //}
});
}

jQuery('#comment_textarea').keyup(function(){
if(this.value.length >= 160) {
//handle the over the limit part here
jQuery(this).addClass('overlimit');
this.value = this.value.substring(0, 160);
jQuery('#comment_textareadiv').html('<p>characters finished</p>'); 
} else {
  
jQuery(this).removeClass('overlimit');
jQuery("#comment_textareadiv").text(160-this.value.length+' chars remaining');
}
});
</script>	
</div>
<div class="comments_display">
<h2>Comments</h2>	
<ul>
<?foreach($this->comments as $comment):?>
<li id="comment_<?=$comment['id'];?>"><?=$comment['body'];?>
<p class="author">Created by :<?=$comment['login'];?> </p>
<?php if (Session::get('loggedIn') == true):?>
<p>
	[ <a href="<?php echo URL;?>post/del_comment/<?=$comment['id'];?>" onclick="del_comment(<?=$comment['id'];?>);return false;">delete</a> ]
<p>
<?endif;?>
</li>	
<?endforeach;?>
</ul>
</div>
