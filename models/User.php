<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $created
 * @property string $active_account
 * @property string $active_additional
 * @property string $active_phone
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'name'], 'required'],
            [['active_account', 'active_additional', 'active_phone'], 'integer'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['email', 'password'], 'string', 'max' => 255],
            ['email', 'emailValidation', 'message' => 'Email already exists.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'created' => 'Created',
            'active_account' => '$29.95/month - Buy/Active your account',
            'active_additional' => 'Additional Active',
            'active_phone' => '$4.99/month - Buy/Active reverse phone',
        ];
    }

    public function emailValidation()
    {
        $email = User::findOne(['email' => $this->email]);
        if($email)
        {
            $this->addError('email', 'This email is already taken.');
            return false;
        }
        else
            return true;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    //relatuins
    public function getCards()
    {
        return $this->hasMany(Card::className(), ['userid' => 'id']);
    }
    public function getPayhistories()
    {
        return $this->hasMany(Payhistory::className(), ['userid' => 'id']);
    }
}
