<?php defined('SYSPATH') or die('No direct script access.');

class Controller_api_media extends Controller_Api_SuperController {

    function before(){

    }

    public function action_delete($image_id){
        list($image) = DB::select('ad_media.*')->from('ad_media')->where('id', '=', $image_id)->execute()->as_array();

        list($ad) = DB::select('*')->from('ads')->where('id', '=', $image['ad_id'])->execute()->as_array();

        $userid = Auth::instance()->get_user()->id;

        if($userid != $ad['owner']){
            throw new Kohana_HTTP_Exception_403('Yeah, no.');
        }

    }

}