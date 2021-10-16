<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "errors".
 *
 * @property string|null $dateCreate
 * @property int|null $code
 * @property string|null $action
 * @property string|null $info
 */
class Errors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'errors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dateCreate'], 'safe'],
            [['code'], 'integer'],
            [['action'], 'string', 'max' => 100],
            [['info'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dateCreate' => 'Date Create',
            'code' => 'Code',
            'action' => 'Action',
            'info' => 'Info',
        ];
    }
}
