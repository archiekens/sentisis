<?php
App::uses('AppModel', 'Model');
/**
 * Keyword Model
 *
 */
class Keyword extends AppModel {

    public $validate = [
        'word' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Word is required.'
            ],
            'letters' => [
                'rule' => 'alphaNumeric',
                'message' => 'Word cannot contain spaces, numbers or special characters.'
            ]
        ]
    ];
}
