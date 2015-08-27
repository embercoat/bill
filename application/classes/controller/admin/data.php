<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 * @author Stefan Sundin <stefan@stefansundin.com>
 * @author Alexandra Tsampikakis <alexandra.tsampikakis@gmail.com>
 */

class Controller_Admin_data extends Controller_Admin_SuperController{
	function before(){
        $this->js[] = '/js/jquery.hotkeys.js';
        $this->js[] = '/js/admin/data.js';
        parent::before();
	}

	public function action_index(){
		$this->content = 'data';
	}

	public function action_skills(){
        $this->content = View::Factory('admin/skills');
        $this->content->skills = DB::select('*')
                        ->from('skill')
                        ->order_by('name', 'asc')
                        ->execute()
                        ->as_array();
	}

	public function action_delSkill($sid){
	    DB::delete('skill')
	        ->where('sid', '=', $sid)
	        ->limit(1)
	        ->execute();

	    $this->request->redirect('/admin/data/skills');
	}

	public function action_editSkill(){
	    if($_POST['skill_id'] !== 'new'){
            $sql = DB::update('skill')
		        ->set(array(
		        	'name' => $_POST['newname'],
		        	'desc' => $_POST['desc']
		        ))
		        ->where('sid', '=', $_POST['skill_id']);
		        $sql->execute();
	    } else {
	        DB::insert('skill', array('name', 'desc'))
	            ->values(array('name' => $_POST['newname'], 'desc' => $_POST['desc']))
	            ->execute();
	    }
        $this->request->redirect('/admin/data/skills');
	}
}




?>
