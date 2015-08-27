<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ad extends Controller_SuperController {

    function before(){
        if(!Auth::instance()->logged_in('login')) {
            $this->request->redirect('/user/login/?redirect='.urlencode($this->request->uri()));
        }
    }

    public function action_start()
    {
        $this->content = "index!";
    }
    public function action_show($id){
        $this->content = View::factory('ad/show');
        $this->content->data = Model::factory('ad')->get_ad_data($id);
        $this->content->images = Model::factory('ad')->get_ad_images($id);
        $this->js[] = '/js/masonry.js';
    }
    public function action_create(){
        if(isset($_POST) && !empty($_POST)){
            Model::factory('ad')->update_ad($this->request->post('ad_id'), $this->request->post('title'), $this->request->post('description'), 2);
            $this->request->redirect('/ad/show/'.$this->request->post('ad_id'));
        }

        $this->css[] = '/css/form.css';
        $this->js[] = '/js/jquery.ui.js';
        $this->js[] = '/js/jquery.fileupload.js';
        $this->js[] = '/js/lzw.js';
        $this->content = View::factory('ad/create');
        $this->content->ad_id = Model::factory('ad')->create_empty_ad();
    }

}