<?if(!isset($this->update_success)){?>
	<?if(isset($this->error)){?>
	<div class="error"><?=$this->error;?></div><?}?>
<form action="<?php echo URL; ?>post/edit/<?=$this->post['id'];?>" method="post" id="post_form" onsubmit="post_data();return false;">

  <fieldset>
	   <legend>Edit Post</legend>
   
			 
		 <div>
		    <label> </label>
		    <textarea cols="60" name="post[body]" id="post_textarea" rows="20"><?=$this->post['body'];?></textarea>
	  
		 </div>
		 <div id="post_textareadiv" style="font-size:10px"></div>
		  
	 
		  <input type="submit" id="submit_post" value="submit" />

	 </fieldset>

</form>

<script type="text/javascript">
function post_data(){
   var formData = $('#post_form').serialize();
   $.ajax({
       url: '<?php echo URL; ?>post/edit/<?=$this->post['id'];?>',
       type: 'post',
       data: formData,
       success:function (data, textStatus) {$("#post_display").html(data);}
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
	
<?=$this->result['body'];?>
<p class="author">Created by :<?=$this->result['login'];?> </p>	

<?php if (Session::get('loggedIn') == true):?>
<p>
  [ <a href="<?php echo URL;?>post/edit/<?php echo $this->result['id'];?>" onclick="edit_post();return false;">edit</a> ]
	
<p>
<?endif;?>
<script type="text/javascript">
function edit_post(){
   $.ajax({
       url: '<?php echo URL;?>post/edit/<?php echo $this->result['id'];?>',
       type: 'post',
       success:function (data, textStatus) {$("#post_display").html(data);}
     
});
}
</script>
<?}?>