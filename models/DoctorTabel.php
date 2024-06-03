<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctorTabel".
 *
 * @property int $id
 * @property int $docID
 * @property string $workingDayStart
 * @property string $workingDayEnd
 * @property int $clientType
 * @property int $freeDay
 */
class DoctorTabel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctorTabel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['docID', 'workingDayStart', 'workingDayEnd'], 'required'],
            [['docID', 'clientType', 'freeDay'], 'integer'],
            [['workingDayStart', 'workingDayEnd'], 'string'],
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
            'workingDayStart' => 'Working Day Start',
            'workingDayEnd' => 'Working Day End',
            'clientType' => 'Client Type',
            'freeDay' => 'Free Day',
        ];
    }
}
