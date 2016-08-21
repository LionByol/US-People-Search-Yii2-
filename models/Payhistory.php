<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property int $kind
 * @property float $cost
 * @property string $datepaid
 * @property string $userid
 */
class Payhistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payhistory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kind', 'userid'], 'integer'],
            [['datepaid', 'userid', 'cost'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kind' => 'Type',           //1:account_active, 2:phone_active, 3:additional_payment
            'cost' => 'Cost',
            'datepaid' => 'Last Date',
            'userid' => 'User',
        ];
    }

    //relations
    public function getUser()
    {
        return $this->hasOne(User::className, ['id' => 'userid']);
    }
}
