<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $result
 * @property int $kind
 * @property int $userid
 * @property string $search_date
 */
class SearchHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'searchhistory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kind', 'userid'], 'integer'],
            [['query1', 'query2'], 'string'],
            [['result', 'search_date', 'query1', 'query2'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'result' => 'Search Result',           //1:account_active, 2:phone_active, 3:additional_payment
            'kind' => 'Type',
            'userid' => 'User',
            'searchdate' => 'Search Date',
        ];
    }

    //relations
    public function getUser()
    {
        return $this->hasOne(User::className, ['id' => 'userid']);
    }
}
