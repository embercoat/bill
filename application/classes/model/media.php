<?php
class model_media extends Model {
    function create_image_to_ad($imagedata, $imagename, $imagemime, $ad_id){

        $md5sum  = md5($imagedata);
        if(!is_dir(DOCROOT.'upload/ad_media/'.$ad_id.'/')){
            mkdir(DOCROOT.'upload/ad_media/'.$ad_id.'/');
        }
        file_put_contents(DOCROOT.'upload/ad_media/'.$ad_id.'/'.$md5sum.'_'.urlencode($imagename), $imagedata);

        list($id, $rows) = DB::insert('ad_media', array('filename', 'md5sum', 'mime', 'ad_id'))->values(array($imagename, $md5sum, $imagemime, $ad_id))->execute();
        return $id;

    }
    function get_md5($id){
        list($r) = DB::select('md5sum')->from('ad_media')->where('id', '=', $id)->execute()->as_array();
        return $r['md5sum'];
    }
    function get_images_for_ads($ads){
        $ad_images = array();
        $images = DB::select_array(array('id', 'ad_id'))->from('ad_media')->where('ad_id', 'in', $ads)->execute()->as_array();
        foreach($images as $i)
            $ad_images[$i['ad_id']][] = $i['id'];

        return $ad_images;
    }
    function render_media_element($id, $height = false){
        $sql = DB::select('*')->from('ad_media')->where('id', '=', $id);
        list($media) = $sql->execute()->as_array();
        list($group, $type) = explode("/", $media['mime']);

        switch($group){
            case "image":{
                return '<img src="/media/image/'.$media['id'].'/'.$media['filename'].'?'. (($height) ? 'height='.$height : '').'" />';
                break;
            }

        }
    }
    function delete($media_id){

    }
}