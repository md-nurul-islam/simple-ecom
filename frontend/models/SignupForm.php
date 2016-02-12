<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Member;
use common\models\MemberProfile;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $name;
    public $email;
    public $address;
    public $contact_number;
    public $password;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['address', 'filter', 'filter' => 'trim'],
            ['address', 'required'],
            ['contact_number', 'filter', 'filter' => 'trim'],
            ['contact_number', 'required'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Member', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'required'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

    /**
     * Signs user up.
     *
     * @return Member|null the saved model or null if saving fails
     */
    public function signup() {
        if ($this->validate()) {
            $member = new Member();
            $member->email = $this->email;
            $member->setPassword($this->password);
            $member->generateAuthKey();
            $member->beforeSave(TRUE);
            if ($member->save()) {
                $member_profile = new MemberProfile();
                $member_profile->name = $this->name;
                $member_profile->address = $this->address;
                $member_profile->contact_number = $this->contact_number;
                $member_profile->member_id = $member->id;
                $member_profile->beforeSave(TRUE);
                if ($member_profile->save()) {
                    return $member;
                }
            }
        }

        return null;
    }

}
