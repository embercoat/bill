<?php
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_Dynamic extends Controller_Admin_SuperController{
	public function action_index(){
	    $sub = DB::select('id', 'name', 'edited', 'editor')->from('dynamic')->order_by('edited', 'DESC');
	    $dynamics = DB::select('*')->from(array($sub, 'temp'))->group_by('name')->execute()->as_array();
		$this->content = View::Factory('admin/dynamic/mainDynamics');
		$this->content->dynamics = $dynamics;
	}
	
	public function action_delete($id = false){
		if($id){
			if(is_numeric($id)){
				Model::factory('dynamic')->delete_by_id($id);
			} else {
				Model::factory('dynamic')->delete_by_name($id);
			}
		}
		$this->request->redirect('/admin/dynamic');		
	}
}
			



?>