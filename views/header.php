<!doctype html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />	
	<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
	
	
	<?php
	if (isset($this->js)) 
	{
		foreach ($this->js as $js)
		{
			echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
		}
	}
	?>
</head>
<body>

<?php Session::init(); ?>
	
<div id="header">
     <a href="<?php echo URL; ?>index">Index</a>
	<?php if (Session::get('loggedIn') == false):?>

	<?php endif; ?>	
	<?php if (Session::get('loggedIn') == true):?>
		<a href="<?php echo URL; ?>post/new_post">Create</a>

		
		<a href="<?php echo URL; ?>post/logout">Logout</a>	
	<?php else: ?>
		<a href="<?php echo URL; ?>login">Login</a>
	<?php endif; ?>
</div>
	
<div id="content">
	
	