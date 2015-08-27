<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_upload extends Controller_Api_SuperController {

    function before(){
        if(!Auth::instance()->logged_in('login')) {
            throw new Kohana_HTTP_Exception_401('Not logged in');
        }
    }

    public function action_imageToAd(){

            $file = $_POST['imagedata'];

            list($type, $file) = explode(';', $file);
            list(, $file) = explode(',', $file);
            list(, $type) = explode(':', $type);

            Log::instance()->add(Log::INFO, 'Standard upload size: ' . strlen($file));

            $file = base64_decode($file);

            $filename = $_POST['filename'];
            $ad = $_GET['ad'];
            $imageID = Model::factory('media')->create_image_to_ad($file, $filename, $type, $ad);

            $md5 = Model::factory('media')->get_md5($imageID);

            $this->data = array('url' => '/upload/ad_media/' . $ad . '/' . $md5 . '_' . urlencode($filename), 'filename' => $filename, 'image_id' => $imageID);
    }

}