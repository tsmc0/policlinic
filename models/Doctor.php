<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "doctor".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $father_name
 * @property int $regID
 * @property int $date_create
 * @property int $profID
 * @property string|null $avatar
 * @property int $timePerClient
 */
class Doctor extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'doctor';
    }

    public static function findByUsername($username): ?Doctor
    {
        return Doctor::findOne(['login' => $username]);
    }

    public function validatePassword($password): bool
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function getSpecData($where)
    {
        $doc = Doctor::find()->where($where)->asArray()->all();
        $newArr = [];

        foreach ($doc as $d){
            $docSpec = DoctorSpec::find()->where(['id' => $d['profID']])->asArray()->all()[0];
            $docRegion = Region::find()->where(['id' => $d['regID']])->asArray()->all()[0];

            $polInfo = Policlinic::find()->where(['id' => $docRegion['polID']])->asArray()->all()[0];

            $newArr[] = ['docInfo' => $d, 'docSpec' => $docSpec, 'docReg' => $docRegion, 'polInfo' => $polInfo];
        }

        return $newArr;
    }

    public static function findIdentity($id)
    {
        return Doctor::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
       return $this->id;
    }

    public function getAuthKey(): string
    {
        return '123';
    }

    public function validateAuthKey($authKey): bool
    {
        return true;
    }
}
