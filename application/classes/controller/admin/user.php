<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_User extends Controller_Admin_SuperController {

	public function action_index()
	{
		$this->content = View::factory('admin/user/main');
		$this->content->users =
			DB::select('*')
				->from('users')
				->order_by('users.lastname', 'ASC')
				->order_by('users.firstname', 'ASC')
				->execute()
				->as_array();
	}
	public function action_detail($id){
		$this->css[] = '/css/admin/user.css';
		if(isset($_POST) && !empty($_POST)){
			unset($_POST['submit']);
            Auth::instance()->get_user()->change_user_details($id, $_POST);
			$_SESSION['message']['success'][] = 'Uppgifterna har uppdaterats.';
		}
		$this->content = View::factory('admin/user/details');
        $this->content->roles = Auth::instance()->get_user()->get_all_roles();
        $this->content->user_roles = array();
        foreach (Auth::instance()->get_user()->get_user_roles($id) as $role) {
            $this->content->user_roles[] = $role['id'];
        }


		list($this->content->user) =
			DB::select('*')
				->from('users')
				->where('id', '=', $id)
				->execute()
				->as_array();
        //$this->content->user = Auth::instance()->get_user();
	}
	public function action_create(){
	    if(isset($_POST) && !empty($_POST)){
	        user::create_user('', '', $_POST['username'], $_POST['password'], '', 118, '', '', $_POST['usertype']);

	    }
	    $this->content = View::factory('/admin/user/createUser');
	}
	public function action_changePassword(){
		if($_POST['newPassword'] == $_POST['newPassword2']) {
			if(strlen($_POST['newPassword']) >= 6){
				$user = Auth::instance()->get_user();
                $user->password = Auth::hash($_POST['newPassword']);
                $user->save();
				$_SESSION['message']['success'][] = 'Lösenordet har uppdaterats.';
			} else {
				$_SESSION['message']['fail'][] = 'Lösenordet är för kort. Minst 6 tecken.';
			}
		} else {
			$_SESSION['message']['fail'][] = 'Lösenorden matchar inte. Försök igen.';
		}
		$this->request->redirect('/admin/user/detail/'.$_POST['id']);
	}

} // End Welcome
