<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctorTake".
 *
 * @property int $id
 * @property int $docID
 * @property int $regID
 * @property int $userID
 * @property string $time_write
 */
class DoctorTake extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctorTake';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['docID', 'regID', 'userID', 'time_write'], 'required'],
            [['docID', 'regID', 'userID'], 'integer'],
            [['time_write'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'docID' => 'Doc ID',
            'regID' => 'Reg ID',
            'userID' => 'User ID',
            'time_write' => 'Time Write',
        ];
    }
}
