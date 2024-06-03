<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $title
 * @property string $district
 * @property int $numeral
 * @property int $polID
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'district', 'numeral', 'polID'], 'required'],
            [['title', 'district'], 'string'],
            [['numeral', 'polID'], 'integer'],
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
            'district' => 'District',
            'numeral' => 'Numeral',
            'polID' => 'Pol ID',
        ];
    }
}
