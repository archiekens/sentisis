<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * SystemUser Model
 *
 */
class SystemUser extends AppModel {

	public $validate = [
        'username' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Username is required.'
            ],
            'alphaNumeric' => [
                'rule' => 'alphaNumeric',
                'message' => 'Please enter only alphanumeric characters.'
            ],
            'setMin' => [
                'rule' => ['minLength', '4'],
                'message' => 'Username must be than 4 characters.',
            ],
            'unique' => [
                'rule' => 'isUnique',
                'message' => 'This username is already in use.',
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
            'match_confirm' => [
                'rule' => ['matchConfirm'],
                'message' => 'Passwords do not match.'
            ]
        ],
        'confirm_password' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'Confirm password is required.'
            ],
            'alphaNumeric' => [
                'rule' => 'alphaNumeric',
                'message' => 'Please enter alphanumeric characters.'
            ],
            'char_length' => [
                'rule' => ['lengthBetween', 8,32],
                'message' => 'Please input minimum of 8 characters up to 32 characters.'
            ]
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

    public function matchConfirm() {
        $request = Router::getRequest()['data'];
        if (!isset($request['SystemUser']['confirm_password'])) {
            return true;
        }
        if ($request['SystemUser']['password'] == $request['SystemUser']['confirm_password']) {
            return true;
        } else {
            return false;
        }
    }

}
