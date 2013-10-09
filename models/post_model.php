<?php

class Post_Model extends Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function create() 
	{
		$post_data=$_POST;
		  mysql_real_escape_string($post_data['post']['body']);
	if(!$this->__validate($post_data['post']['body']))
	
	{return false;}
	
	else{
		$user_id=Session::get('userid');
		$this->db->insert('posts', array('body' => $post_data['post']['body'],'user_id'=>$user_id,'created_at'=>date('y/m/d h:m')));
		
		
		return $this->db->lastInsertId();
		
	}
	}
 
	public function viewall(){
	$query = $this->db->prepare("SELECT posts.id,posts.body,posts.created_at,users.login FROM posts LEFT JOIN users ON	  
							users.userid=posts.user_id ORDER BY posts.id DESC");
		//print_r($query)	;	
		$query->execute();
	
		$rec = array();
while ($data = $query->fetch()) {
				
          $rec[] = $data;
}
return $rec;
	}
	 
	public function view($id){
		mysql_real_escape_string($id);
	$query = $this->db->prepare("SELECT posts.id,posts.body,posts.created_at,users.login FROM posts LEFT JOIN users ON	  
							users.userid=posts.user_id WHERE 
				id = :id");
		//print_r($query)	;	
		$query->execute(array(
			':id' => $id
				));
		
		$data = $query->fetch();	
		
		return $data;
	}
public function getcomments($id){
		mysql_real_escape_string($id);
	$query = $this->db->prepare("SELECT comments.id,comments.body,comments.created_at,users.login FROM comments LEFT JOIN users ON	  
							users.userid=comments.user_id WHERE 
				post_id = :id ORDER BY comments.id DESC");
		$query->execute(array(
			':id' => $id
				));		
		$rec = array();
while ($data = $query->fetch()) {
				
          $rec[] = $data;
}
return $rec;
			

	}
public function update_post($id){
	$post_data=$_POST;
	mysql_real_escape_string($post_data['post']['body']);
	if(!$this->__validate($post_data['post']['body']))
	
	{   
		return false;}
	
	else{$postData = array(
			'body' => $post_data['post']['body']
		);
		
		$res=$this->db->update('posts', $postData, "`id` = {$id}");
		return true;
	}
	
}
public function add_comment() 
	{
		$post_data=$_POST;
		  mysql_real_escape_string($post_data['comment']['body']);
	if(!$this->__validate($post_data['comment']['body']))
	
	{return false;}
	
	else{
		$user_id=Session::get('userid');
		$this->db->insert('comments', array('body' => $post_data['comment']['body'],'user_id'=>$user_id,'post_id'=>$post_data['comment']['post_id'],'created_at'=>date('y/m/d h:m')));
		
		
		return $this->db->lastInsertId();
		
	}
	}
public function delete_comment($id)
	{   $user_id=Session::get('userid');
		$query=$this->db->delete('comments', "id = '$id'");
		if($query){return true;}
		else{return false;}
		
	}	
public function delete($id)
	{   $user_id=Session::get('userid');
		$query=$this->db->delete('posts', "id = '$id'");
		if($query){return true;}
		else{return false;}
		
	}	
		
public function __validate($data){
	if($data==''){return false;}
	else{return true;}
	
}	
}


?>