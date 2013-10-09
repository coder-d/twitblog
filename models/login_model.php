<?php

class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function run()
	{
		$query = $this->db->prepare("SELECT userid FROM users WHERE 
				login = :login AND password = :password");
		$query->execute(array(
			':login' => $_POST['login'],
			':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
		));
		
		$data = $query->fetch();
		$count =  $query->rowCount();
		if ($count > 0) {
			// login
			Session::init();
			Session::set('loggedIn', true);
			Session::set('userid', $data['userid']);
			header('location: ../index');
		} else {
			header('location: ../login');
		}
		
	}
	
}