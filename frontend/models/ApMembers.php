<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ap_members".
 *
 * @property integer $id
 * @property string $username
 * @property string $fullname
 * @property string $email
 * @property string $password
 * @property integer $terms
 * @property string $browser
 * @property string $balance
 * @property integer $admin_user
 * @property integer $referrar_id
 */
class ApMembers extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ap_members';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fullname', 'email', 'password', 'terms', 'browser', 'balance', 'admin_user'], 'required'],
            [['terms', 'admin_user', 'referrar_id'], 'integer'],
            [['balance'], 'number'],
            [['username'], 'string', 'max' => 30],
            [['fullname'], 'string', 'max' => 50],
            [['email', 'password', 'browser'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'password' => 'Password',
            'terms' => 'Terms',
            'browser' => 'Browser',
            'balance' => 'Balance',
            'admin_user' => 'Admin User',
            'referrar_id' => 'Referrared By',
        ];
    }

    public static function find() {
        return new ApMembersQuery(get_called_class());
    }

}
