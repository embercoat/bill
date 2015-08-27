<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Kohana_Controller{
	protected $attempt = false;
	protected $logged_in = false;

	public function before(){
		$this->session = Session::instance();
    	if($this->session->get('user') === NULL){
    		$this->session->set('user', user::instance());
    	}
    	$this->content = View::Factory('loginform');
	}
	public function action_login(){
		if(!empty($_POST)){
			$this->attempt = true;
			user::instance()->login_by_username_and_password($_POST['username'], $_POST['password']);
			if(user::instance()->logged_in()){
				Session::instance()->set('user', user::instance());
				$this->request->redirect(str_replace('_', '/', $_POST['redirect']));
			}
		}
	}
	public function action_logout(){
		Session::instance()->destroy();
		$this->request->redirect($_SERVER['HTTP_REFERER']);
	}
	public function action_index($arg1 = false, $arg2 = false)
	{
		if($arg1){
			if(method_exists($this, 'action_'.$arg1)){
				$method = 'action_'.$arg1;
				if($arg2)
					$this->$method($arg2);
				else
					$this->$method();
			}
		}
	}
	public function action_redirect($redirect = '') {
		$this->redirect = $redirect;
	}
	public function action_recover(){
	    /*$this->content = View::factory('recover_password');
	    if(isset($_POST) && !empty($_POST)){
	        $this->content->email = $_POST['email'];
	        $userid = user::get_userid_by_field('email', $_POST['email']);
	        if($userid){
	            $new_password = user::random_password();
	            $smtp = Model::Factory('SMTPClient');
	            $smtp->config(
	                    'send.one.com',
	                    '2525',
	                    'no-reply@larv.org',
	                    'Qj0ttngp',
	                    'no-reply@larv.org',
	                    $_POST['email'],
	                    'Nytt lösenord',
	                    View::factory('mail/newpassword')->set('password', $new_password)
	                    );
	            user::change_password($userid, $new_password);
	            $smtp->SendMail();

                $this->content->message = 'Ditt nya lösenord har skickats till den adress du angav. <br /><a href="/login/" style="color: white">Logga In</a>';

	        } else {
                $this->content->message = 'Det finns ingen användare med den adressen';
	        }
	    }*/
	}
	public function after(){
		$this->content->attempt = $this->attempt;
		if ($this->attempt)
			$this->content->username = $_POST['username'];
		if (isset($this->redirect))
			$this->content->redirect = $this->redirect;
		$this->response->body($this->content);
	}

} // End Welcome
