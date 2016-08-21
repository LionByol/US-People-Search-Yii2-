<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property integer $id
 * @property string $name
 * @property string $number
 * @property integer $expireyear
 * @property integer $expiremonth
 * @property string $cvv
 * @property string $zipcode
 * @property integer $userid
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number', 'expireyear', 'expiremonth', 'cvv', 'zipcode'], 'required'],
            [['expireyear', 'expiremonth', 'userid'], 'integer'],
            [['name', 'number'], 'string', 'max' => 50],
            [['cvv'], 'string', 'max' => 10],
            [['zipcode'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Cardholder Name',
            'number' => 'Card Number',
            'expireyear' => 'Expiration Year',
            'expiremonth' => 'Expiration Month',
            'cvv' => 'Cvv',
            'zipcode' => 'Billing Zipcode',
            'userid' => 'Userid',
        ];
    }

    //relations
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }
}
