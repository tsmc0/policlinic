<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "policlinic".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property int $type
 */
class Policlinic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'policlinic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address'], 'required'],
            [['title', 'address'], 'string'],
            [['type'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'address' => 'Address',
            'type' => 'Type',
        ];
    }
}
