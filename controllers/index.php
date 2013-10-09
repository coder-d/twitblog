<?php

class Index extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$uid=Session::get('loggedIn');
		require 'models/post_model.php';
		$model = new Post_Model();
		$posts=$model->viewall();
        $this->view->posts=$posts;
		$this->view->render('index/index');
	}
	
	function details() {
		$this->view->render('index/index');
	}
	
}