<?php

namespace app\models;

use yii\base\Model;

class DocWrite extends Model
{

    public $writeTime;
    public $docID;
    public $userID;
    public $regID;

    public function rules()
    {
        return [
            [['writeTime', 'docID', 'userID', 'regID'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'writeTime' => '',
            'docID' => '',
            'userID' => '',
            'regID' => '',
        ];
    }

    public function saveRecord($postData): bool
    {
        $m = new DoctorTake();
        $m->time_write = $postData['DocWrite']['writeTime'];
        $m->docID = $postData['DocWrite']['docID'];
        $m->regID = $postData['DocWrite']['regID'];
        $m->userID = 1;

        return $m->save();
    }

}