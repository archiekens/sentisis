<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Customer Model
 *
 */
class Customer extends AppModel {

    public $validate = [
        'email' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Email is required.'
            ],
            'email' => [
                'rule' => 'email',
                'message' => 'Please enter a valid email address.'
            ]
        ],
        'password' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Password is required.'
            ],
            'alphaNumeric' => [
                'rule' => 'alphaNumeric',
                'message' => 'Please enter alphanumeric characters.'
            ],
            'char_length' => [
                'rule' => ['lengthBetween', 8,32],
                'message' => 'Please input minimum of 8 characters up to 32 characters.'
            ],
        ]
    ];

    /**
     * beforeSave
     *
     * hash password
     * @return bool
     */
    public function beforeSave($options = []) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
        return true;
    }

}
