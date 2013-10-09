<h1>Index</h1>
<div class="main_page">
<ul>
		<?foreach($this->posts as $post):?>
<li id="post_<?=$post['id'];?>"><a href="<? echo URL;?>post/view/<?=$post['id'];?>"><?=$post['body'];?></a>
<?php if (Session::get('loggedIn') == true):?>
<p>
	[ <a href="<?php echo URL;?>post/delete/<?=$post['id'];?>" onclick="delete_post(<?=$post['id'];?>);return false;">delete</a> ]
<p>
<?endif;?>	
	
</li>
<?endforeach;?>
</ul>
</div>
<script type="text/javascript">
function delete_post(id){
   $.ajax({
       url: '<?php echo URL;?>post/delete/'+id+'',
       type: 'post',
       success:function (data, textStatus) {$("#post_"+id).html(data);}
    
});
}
</script>
	
