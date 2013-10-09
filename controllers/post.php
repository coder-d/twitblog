<?php

class Post extends Controller {

	function __construct() {
		parent::__construct();
		
	}
	


     function new_post() 
     
	{	Auth::handleLogin();
		if(!empty($_POST)){
			
			$create=$this->model->create();
		  if($create){
		   $this->view->post_id=$create;
		   $this->view->content=mysql_real_escape_string($_POST['post']['body']);
		   $this->view->success=1;
		  }
		  else{$this->view->error = 'Post cannot be empty';}
			
			$this->view->render('post/new_post',1);return;
		}
		
		$this->view->render('post/new_post');
	}

	function view($id) 
	{	
		$result=$this->model->view($id);
		if($result){
		$comments=$this->model->getcomments($id);
		
			$this->view->comments=$comments;
			$this->view->result=$result;
			$this->view->success=1;
		}
		$this->view->render('post/view');
	}
	function edit($id){
	Auth::handleLogin();
	$post=$this->model->view($id);
	if($post){
		$this->view->post=$post;
		$this->view->success=1;
	}
	
	if(!empty($_POST)){
	if($this->model->update_post($id)){
		$this->view->update_success=1;
		$result=$this->model->view($id);
		$this->view->result=$result;
		
		
	}
	else{$this->view->error = 'Post cannot be empty';}	
	}
	
	$this->view->render('post/edit',1);	
	}
	function add_comment(){
		Auth::handleLogin();
		if(!empty($_POST)){
			
			$create=$this->model->add_comment();
		  if($create){
		  	}
		  else
			  { 
		  	$this->view->comment_error = 'Comment cannot be empty';}
			
		  
	  }
	    $this->view->result=$_POST['comment'];
		$comments=$this->model->getcomments($_POST['comment']['post_id']);
		$this->view->comments=$comments;
		$this->view->render('post/add_comment',1);
		
	}
  function del_comment($id){
  	Auth::handleLogin();
  	if($this->model->delete_comment($id)){
  	$this->view->success=1;	
  		
  	}
  	$this->view->render('post/del_comment',1);
  	
  }
  function delete($id){
  	Auth::handleLogin();
  	if($this->model->delete($id)){
  	$this->view->success=1;	
  		
  	}
  	
  	$this->view->render('post/delete',1);
  	
  }	
  function logout()
	{   Auth::handleLogin();
		Session::destroy();
		header('location: ' . URL .  'login');
		exit;
	}
	
}

?>