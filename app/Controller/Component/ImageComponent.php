<?php

App::uses('Component', 'Controller');
App::uses('Folder', 'Utility');

class ImageComponent extends Component {
    /**
    * Generate image file name
    *
    * @return String MD5 hashed current timestamp with millisecond
    */
    private function generateImageFileName() {
        return md5(microtime(true).mt_rand()) . '.jpg';
    }

    /**
    * @author Arnold
    * @param String $tmp_image_file_name Temporary image uploaded in tmp directory
    * @return String Image file name
    */
    public function save($tmp_image_file_name, $type, $id = null) {
        $file_name = $this->generateImageFileName();
        try {
            switch ($type) {
                case 'banner-add':
                    $dir = Configure::read('BANNER_IMAGE_PATH');
                    $temp_dir = Configure::read('IMG_TMP_PATH');
                    // create folder if it does not exist
                    $create_folder = new Folder($dir, true);
                    rename($temp_dir.$tmp_image_file_name,  $dir.$file_name);
                    break;
                case 'banner-edit':
                    $dir = Configure::read('BANNER_IMAGE_PATH');
                    // create folder if it does not exist
                    $create_folder = new Folder($dir, true);
                    rename($tmp_image_file_name,  $dir.$file_name);
                    break;
                case 'tmp':
                    $dir = Configure::read('IMG_TMP_PATH');
                    // create folder if it does not exist
                    $banner_images_temp_folder = new Folder($dir, true);
                    move_uploaded_file($tmp_image_file_name,  $dir.$file_name);
                    break;
            }
            return $file_name;
        } catch(Exception $e) {
            $this->log($e->getMessage(), 'error');
            throw $e;
        }
    }

    /**
    * @author Arnold
    * @param String $image_file_name File name of image to be deleted
    * @return boolean
    */
    public function delete($image_file_name, $type, $id = null) {
        try {
            switch ($type) {
                case 'product':
                    $dir = Configure::read('PRODUCT_IMAGE_PATH');
                    if (is_file($dir.$image_file_name)) {
                        unlink($dir.$image_file_name);
                    }
                    break;
                case 'tmp':
                    $dir = Configure::read('IMG_TMP_PATH');
                    if (is_file($dir.$image_file_name)) {
                        unlink($dir.$image_file_name);
                    }
                    break;
            }
            return true;
        } catch(Exception $e) {
            $this->log($e->getMessage(), 'error');
            throw $e;
        }
    }
}