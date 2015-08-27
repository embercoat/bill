<?php defined('SYSPATH') or die('No direct script access.');

class Controller_media extends Controller_Api_SuperController {

    function before(){

    }

    public function action_image($image_id, $string){

        $height = (isset($_GET['height']) ? $_GET['height'] : 0);
        $width  = (isset($_GET['width']) ? $_GET['width'] : 0);

        list($image) = DB::select('ad_media.*')->from('ad_media')->where('id', '=', $image_id)->execute()->as_array();
        $dir = DOCROOT.'upload/ad_media/'.$image['ad_id'].'/';
        $original_filename = $image['md5sum'].'_'.urlencode($image['filename']);
        $cache_filename = $image['md5sum'].'_'.$height.'x'.$width.'_'.urlencode($image['filename']);

        if(is_file($dir.$cache_filename)){
            echo file_get_contents($dir.$cache_filename);
        } else {
            $img = Image::factory($dir.$original_filename);

            $this->response->headers('Content-Type', $image['mime']);


            if($height == 0 && $width == 0){
                echo $img;
            }
            if($height == 0 && $width > 0){
                //Calc ratio and render
                $ratio = $width / $img->width;

                echo $img->resize($width, NULL);
            }
            if($height > 0 && $width == 0){
                // Calc ration and render
                $ratio = $height / $img->height;

                echo $img->resize(NULL, $height);
            }
            if($height > 0 && $width > 0){
                // Use explicit values and render
                echo $img->resize($width, $height, Image::NONE);
            }
            $img->save($dir.$cache_filename);
            echo $img->render();
        }
    }

}