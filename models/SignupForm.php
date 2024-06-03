<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $father_name;
    public $email;
    public $dateBirth;
    public $medPolis;
    public $password;
    public $repeat_password;
    public $polID;
    public $regID;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'repeat_password', 'dateBirth', 'first_name', 'last_name', 'father_name', 'email', 'medPolis', 'polID', 'regID'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'father_name' => 'Отчество',
            'email' => 'EMAIL',
            'dateBirth' => 'Дата рождения',
            'medPolis' => 'Номер медполиса',
            'polID' => 'Поликлиника преписания',
            'regID' => 'Участок',
            'repeat_password' => 'Повтор пароля',
            'password' => 'Пароль',
        ];
    }

    public function saveUser()
    {
        $u = new User();
        $u->username = $this->username;
        $u->first_name = $this->first_name;
        $u->last_name = $this->last_name;
        $u->father_name = $this->father_name;
        $u->date_birth = $this->dateBirth;
        $u->regionID = $this->regID;
        $u->polID = $this->polID;
        $u->medPolis = $this->medPolis;
        $u->email = $this->email;
        $u->date_create = time();
        $u->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $u->authKey = Yii::$app->getSecurity()->generateRandomString();

        return $u->save();
    }

}
