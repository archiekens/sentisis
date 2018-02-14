<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 */
class Product extends AppModel {

	/**
     * validate
     *
     * @var array
     */
    public $validate = [
        'name' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Name is required.'
            ]
        ],
        'image' => [
            'extension' => [
                'rule' => ['checkExtension'],
                'message' => 'Image must be jpg, png, or jpeg.'
            ],
            'size' => [
                'rule' => ['checkSize'],
                'message' => 'Image must be less than 5MB.',
            ]
        ]
    ];

    /**
    * checkSize
    * validate input if valid image file size less than equal to 5mb
    * @author Arnold
    * @param $data array
    * @return boolean
    **/
    function checkSize($data) {
        $data = current($data);
        if (isset($data['size'])) {
            if ($data['size'] <= 5000000) {
                return true;
            }
            return false;
        }
        return true;
    }

    /**
    * checkExtension
    * validate input if valid image file extension (jpg, png, jpeg)
    * @author Arnold
    * @param $data array
    * @return boolean
    **/
    function checkExtension($data) {
        $data = current($data);
        if (isset($data['type'])) {
            if ($data['type'] == 'image/jpeg' || $data['type'] == 'image/png' ) {
                return true;
            }
            return false;
        }
        return true;
    }

}
