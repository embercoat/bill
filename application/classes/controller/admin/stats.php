<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 */

class Controller_Admin_stats extends Controller_Admin_SuperController{
	function before(){
        $this->js[] = '/js/jquery.hotkeys.js';
        $this->js[] = '/js/admin/data.js';
        parent::before();
	}

	public function action_index(){
		$this->content = 'stats';
	}
	public function action_userstats(){
	    $this->css[] = '/css/admin/stats.css';
	    $users = DB::select_array(array('fname', 'lname', 'user_id'))
	                ->from('user')
	                ->order_by('fname', 'asc')
	                ->order_by('lname', 'asc')
	                ->execute()->as_array();
	    $userskills = array();
	    foreach(DB::select('*')->from('userskill')->execute()->as_array() as $us)
	        $userskills[$us['userid']][$us['skillid']] = 1;
	    $this->content = View::factory('/admin/userstats');
	    $this->content->users = $users;
	    $this->content->userskills = $userskills;
	    $this->content->skills = DB::select('*')->from('skill')->order_by('name')->execute()->as_array();
	}
}
?>