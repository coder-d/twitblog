<?if(!isset($this->success)){?>
<div id="create_form_update">
	<?if(isset($this->error)){?>
	<div class="error"><?=$this->error;?></div><?}?>
<form action="<?php echo URL; ?>post/new_post" method="post" id="post_form" onsubmit="post_data();return false;">

  <fieldset>
	   <legend>Add New Post</legend>
   
			 
		 <div>
		    <label> </label>
		    <textarea cols="60" name="post[body]" id="post_textarea" rows="20"></textarea>
	  
		 </div>
		 <div id="post_textareadiv" style="font-size:10px"></div>
		  
	 
		  <input type="submit" id="submit_post" value="submit" />

	 </fieldset>

</form>
</div>
<script type="text/javascript">
function post_data(){
   var formData = $('#post_form').serialize();
   $.ajax({
       url: '<?php echo URL; ?>post/new_post',
       type: 'post',
       data: formData,
       success:function (data, textStatus) {$("#create_form_update").html(data);}
       //success: function(response){
         //  alert('success');
       //}
});
}

jQuery('#post_textarea').keyup(function(){
if(this.value.length >= 160) {
//handle the over the limit part here
jQuery(this).addClass('overlimit');
this.value = this.value.substring(0, 160);
jQuery('#post_textareadiv').html('<p>characters finished</p>'); 
} else {
  
jQuery(this).removeClass('overlimit');
jQuery("#post_textareadiv").text(160-this.value.length+' chars remaining');
}
});
</script>
<?}else{?>
<div class="success">Post Successfully Created</div>	
<a href="<?php echo URL; ?>post/view/<?=$this->post_id;?>"><?=$this->content;?></a>
	<?}?>
