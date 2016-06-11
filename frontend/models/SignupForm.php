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
    public $is_affiliate;
    public $referrar_id;

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
            [['is_affiliate', 'referrar_id'], 'integer']
        ];
    }

    /**
     * Signs user up.
     *
     * @return Member|null the saved model or null if saving fails
     */
    public function signup() {
        if ($this->validate()) {
            
            $connection = yii::$app->db;
            $transaction = $connection->beginTransaction();
            
            $pw = $this->password;

            try {
                $member = new Member();
                $member->email = $this->email;
                $member->setPassword($pw);
                $member->generateAuthKey();
                $member->beforeSave(TRUE);
                $member->save();

                $member_profile = new MemberProfile();
                $member_profile->name = $this->name;
                $member_profile->address = $this->address;
                $member_profile->contact_number = $this->contact_number;
                $member_profile->member_id = $member->id;
                $member_profile->beforeSave(TRUE);
                $member_profile->save();
                
                if(1 == $this->is_affiliate) {
                    $affiliate = new ApMembers;
                    $affiliate->email = $member->email;
                    $affiliate->fullname = $this->name;
                    $affiliate->balance = '0.00';
                    $affiliate->terms = '1';
                    $affiliate->password = password_hash($pw, PASSWORD_DEFAULT, ["cost" => 10]);
                    $affiliate->admin_user = '0';
                    $affiliate->browser = $_SERVER['HTTP_USER_AGENT'];
                    $affiliate->referrar_id = $this->referrar_id;
                    $affiliate->save();
                }

                $transaction->commit();
                return $member;
            } catch (Exception $exc) {
                $transaction->rollBack();
                throw $e;
            }
        }

        return null;
    }

    public function attributeLabels() {
        return [
            'is_affiliate' => Yii::t('app', 'I want to be an affiliate.'),
        ];
    }

}
