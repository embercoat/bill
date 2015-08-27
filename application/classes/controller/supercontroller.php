<?php
/**
 *
 * @author draco
 * This is the supercontroller that all the other controllers inherit from.
 * Contains the things that are common for all the controllers
 *
 */
class Controller_SuperController extends Kohana_Controller {
    protected $mainView;
    protected $db;
    protected $user;
    protected $content;
    private $starttime;
    private $stats = array();
    protected $css = array();
	protected $js = array();
	/**
	 * This function is run before the controller.
	 * Useful for preparing the environment
	 *
	 */
    public function before(){
        /*$this->session = Session::instance();
    	if($this->session->get('user') === NULL){
    		$this->session->set('user', user::instance());
    	}
        Session::instance();
        if(!$this->session->get('user')->logged_in() && ($this->request->controller() != 'login' && $this->request->controller() != 'register')) {
            $this->request->redirect('/login/redirect/'.str_replace('/', '_', $this->request->uri()));
        }
        */
    }
    /**
     * Runs after everything else.
     * Used here to render the menu and then send the collected response to the client
     */
    public function after(){
    	$this->mainView = View::factory('main');
        $this->mainView->content = $this->content;

        $this->mainView->css = $this->css;
        $this->mainView->js = $this->js;

        $this->response->body($this->mainView);
    }
	public function action_index($arg1 = 'welcome', $arg2 = false)
	{
		$this->request->action($arg1);
		$dynamic = $this->request->controller().(($arg1 && $arg1 != 'edit')?'.'.$arg1.(($arg2 && $arg2 != 'edit')?'.'.$arg2:''):'');
		$method = 'action_'.$arg1;
		if($arg1){
			if($arg1 == 'edit' || $arg2 == 'edit'){
				$this->action_edit($dynamic);
			} else {
				if(method_exists($this, $method) && $method != 'action_edit'){
					if($arg2){
						$this->$method($arg2);
					} else {
						$this->$method();
					}
				} elseif(Model::factory('dynamic')->exists($dynamic)) {
					$this->content = View::factory('dynamic');
					$this->content->dynamic = $dynamic;
					$this->content->edit = false;
				} else {
					$this->content = View::factory('404')->set(array('arg1' => $arg1, 'arg2' => $arg2));
				}
			}
		} else {
			if(Model::factory('dynamic')->exists($dynamic)){
				$this->content = View::factory('dynamic');
				$this->content->dynamic = $dynamic;
				$this->content->edit = false;
			} else {
				$this->content = View::factory('404')->set(array('arg1' => $arg1, 'arg2' => $arg2));
			}
		}
	}
	public function action_edit($dynamic){
		if(isset($_POST) && !empty($_POST)){
			Model::factory('dynamic')->update_by_name($dynamic, $_POST['ckedit']);
			$this->request->redirect('/'.str_replace('.','/',$dynamic));
		}
		$this->content = View::factory('dynamic');
		$this->content->edit = true;
		$this->content->dynamic = $dynamic;
	}

}

?>