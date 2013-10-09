<?php

class View {

	function __construct() {
	
	}

	public function render($name, $ajax = false)
		{
			
		if ($ajax == true) {
			require 'views/' . $name . '.php';	
		}
		else {
			require 'views/header.php';
			require 'views/' . $name . '.php';
			require 'views/footer.php';	
		}
	}

}