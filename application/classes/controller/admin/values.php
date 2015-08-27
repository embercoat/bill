<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Values extends Controller_Admin_SuperController {

	public function action_index()
	{
		if(isset($_POST) && !empty($_POST)){
			foreach($_POST['value'] as $key => $value){
				Model::factory('status')->set($key, $value);
			}
		}
		
		$this->content = View::factory('/admin/values');
	}

} // End Welcome
