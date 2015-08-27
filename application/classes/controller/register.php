<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Register extends Controller_SuperController {

	public function after()
	{
		parent::after();
//		Session::instance()->destroy();
	}
	public function action_index($arg1 = false, $arg2 = false)
	{
		$this->css[] = '/css/form.css';
		$this->content = View::factory('register');
		if(isset($_POST) && !empty($_POST))
		{
			$this->content->register_success = false;
			$error = array();
			if($_POST['password'] != $_POST['password2'])
			{
				$error[] = 'Lösenorden stämmer inte.';
			}
			if(!user::free_username($_POST['username']))
			{
				$error[] = 'Användarnamnet används redan';
			}
			if(count($error) == 0){
				$userid = user::create_user(
					$_POST['fname'],
					$_POST['lname'],
					$_POST['username'],
					$_POST['password'],
					$_POST['email']
				);
				Session::instance()->set('user' ,Session::instance()->get('user')->login_by_user_id(array_shift($userid)));
				$this->content->register_success = true;
				$this->content->name = $_POST['fname'].' '.$_POST['lname'];
			} else {
				$this->content->error = $error;
				$this->content->preset = $_POST;
			}
		}
	}
} // End Welcome
