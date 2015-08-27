<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_SuperController {

	public function action_welcome()
	{
        $this->content = View::factory('main_feed');
		$this->content->ads = Model::factory('ad')->get_ads();
        $ad_ids = array();
        foreach($this->content->ads as $a)
            $ad_ids[] = $a['id'];
        if(count($this->content->ads) > 0)
            $this->content->media = Model::factory('media')->get_images_for_ads($ad_ids);
	}

}