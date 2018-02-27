<?php
App::uses('AppModel', 'Model');
/**
 * Keyword Model
 *
 */
class Keyword extends AppModel {

    public function beforeSave($options = array()) {

        if (!empty($this->data['Keyword']['word'])) {

            $this->data['Keyword']['word'] = strtolower($this->data['Keyword']['word']);
            $this->data['Keyword']['point'] = !empty($this->data['Keyword']['point']) ? $this->data['Keyword']['point'] : 2.5;
        }
        return true;
    }

    public $validate = [
        'word' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Word is required.'
            ],
            'letters' => [
                'rule' => '^[a-zA-Z]+$^',
                'message' => 'Word cannot contain spaces, numbers or special characters.'
            ],
            'unique' => [
                'rule' => 'isUnique',
                'message' => 'This word is already in use.',
            ]
        ],
        'point' => [
            'numeric' => [
                'rule' => 'numeric',
                'message' => 'Point must be a number.',
                'allowEmpty' => true,
            ],
            'zeroToFive' => [
                'rule' => ['range',-0.99,5.01],
                'message' => 'Point must between 0 to 5.'
            ]
        ]

    ];
}
