<?php

require 'config.php';
require 'util/Auth.php';


function __autoload($class) {
	require LIBS . $class .".php";
}





$app = new Bootstrap();
