<?php
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_Guest extends Controller_Admin_SuperController{
	public function action_index(){
		$this->content = View::factory('admin/guest/list');
	    $this->content->guests =DB::select('*')->from('guest')->order_by('lastname', 'ASC')->order_by('firstname', 'ASC')->execute()->as_array();
	}
	
	public function action_party($id = false, $edit = false){
		if($id){
			if(isset($_POST) && !empty($_POST)){
				if($carryon['step1']['unionmember'] == 1)
					$price_banquet = Model::factory('status')->get_value('price_banquet_member');
				else {
					$price_banquet = Model::factory('status')->get_value('price_banquet_nonmember');
				}
				
				$sum_banquet = $price_banquet * $_POST['guest']['num_banquet'];
				
				list($guest_id, $affected_rows) = DB::insert('guest', array('firstname', 'lastname','union_member', 'email', 'class', 'phone', 'num_banquet', 'num_ceremony', 'sum', 'paid'))
				->values(array(
						$carryon['guest']['firstname'],
						$carryon['guest']['lastname'],
						$carryon['guest']['unionmember'],
						$carryon['guest']['email'],
						$carryon['guest']['class'],
						$carryon['guest']['phone'],
						$carryon['guest']['num_banquet'],
						$carryon['guest']['num_ceremony'],
						$sum_banquet,
						0
				))
				->execute();
				foreach($carryon['step2']['banquet'] as $guest){
					DB::insert('party', array('guest_id', 'firstname', 'lastname', 'socialsecurity', 'allergy'))
					->values(array(
							$guest_id,
							$guest['firstname'],
							$guest['lastname'],
							$guest['ssn'],
							$guest['allergy']
					))
					->execute();
				}
			}
			
			list($guest) = DB::select('*')->from('guest')->where('id', '=', $id)->execute()->as_array();
			$party = DB::select('*')->from('party')->where('guest_id', '=', $id)->execute()->as_array();
			if($edit)
				$this->content = View::factory('admin/guest/party_edit');
			else 
				$this->content = View::factory('admin/guest/party');
			$this->content->guest = $guest;
			$this->content->party = $party;
		} else {
			$this->request->redirect('/admin/guest');
		}		
	}
	public function action_pay($id = false){
		if($id){
			DB::update('guest')->value('paid', 1)->where('id', '=', $id)->execute();
			$this->request->redirect('/admin/guest/party/'.$id);
		} else {
			$this->request->redirect('/admin/guest');
		}
	}
	public function action_unpay($id = false){
		if($id){
			DB::update('guest')->value('paid', 0)->where('id', '=', $id)->execute();
			$this->request->redirect('/admin/guest/party/'.$id);
		} else {
			$this->request->redirect('/admin/guest');
		}
	}
}
			



?>