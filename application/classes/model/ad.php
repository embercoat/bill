<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_Ad extends Model
{
    function create_empty_ad(){
        list($id, $rows) = DB::insert('ads', array('owner'))->values(array(Auth::instance()->get_user()->id))->execute();
        return $id;
    }
    function update_ad($id, $title, $description){
        return DB::update('ads')->set(array('title' => $title, 'description' => $description))->where('id', '=', $id)->execute();
    }
    function get_ad_data($id){
        list($result) = DB::select('ads.*')->from('ads')->where('id', '=', $id)->execute()->as_array();
        return $result;
    }
    function get_ad_images($id){
        return DB::select('ad_media.*')->from('ad_media')->where('ad_id', '=', $id)->execute()->as_array();
    }
    function get_ads($limit = false){
        if(!$limit) $limit = 15;

        return DB::select('*')->from('ads')->order_by('updated', 'DESC')->order_by('created', 'DESC')->execute()->as_array();



    }
}