<?php

namespace app\controllers;

use app\models\Doctor;
use app\models\DoctorSpec;
use app\models\DoctorTabel;
use app\models\DoctorTake;
use app\models\DocWrite;
use app\models\LoginDocForm;
use app\models\Policlinic;
use app\models\Region;
use app\models\SignupForm;
use app\models\User;
use DateInterval;
use DatePeriod;
use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
	    setcookie('_doc', '', time()-3600, '/');
		
		return $this->render('index');
    }
	
	public function actionDocview()
	{
		$dates = DoctorTake::find()->where(['docID' => 1])->andFilterWhere(['like', 'time_write', gmdate('d.m.Y')])->asArray()->all();
		$newDates = [];
		
		foreach ($dates as $dx){
			$dx['userID'] = User::find()->where(['id' => $dx['userID']])->asArray()->one();
			$dx['regID'] = Region::find()->where(['id' => $dx['regID']])->asArray()->one();
			
			$newDates[] = $dx;
		}
		
		return $this->render('docview', ['dates' => $newDates]);
	}

    public function actionAdminpanel()
    {
        if (Yii::$app->user->identity->isAdmin === 0){
            return $this->goHome();
        }

        return $this->render('adminpanel');
    }

    public function actionTabel()
    {
        if (Yii::$app->user->isGuest){
            return $this->goHome();
        }

        $model = new DocWrite();

        if (Yii::$app->request->isPost && $model->saveRecord(Yii::$app->request->post())) {
            return $this->refresh();
        }

        if (!is_null($_GET['docid'])) {
            $docInfo = Doctor::find()->where(['id' => $_GET['docid']])->asArray()->all()[0];
            $docSpec = DoctorSpec::find()->where(['id' => $docInfo['profID']])->asArray()->all()[0];
            $polInfo = Policlinic::find()->where(['id' => Region::find()->where(['id' => $docInfo['regID']])->asArray()->all()[0]])->asArray()->all()[0];

            $period = new DatePeriod(
                new DateTime(gmdate('d.m.Y h:i')),
                new DateInterval('P1D'),
                new DateTime(gmdate('d.m.Y h:i', time() + 864000 + 60 * 60 * 24))
            );

            $dates = array();
            foreach ($period as $key => $value) {
                $dates[] = ['date' => $value->format('d.m.Y'), 'info' => DoctorTabel::find()->where(['docID' => $_GET['docid']])->andFilterWhere(['like', 'workingDayStart', $value->format('d.m.Y')])->asArray()->one()];
            }

            return $this->render('tabel', ['model' => $model, 'docInfo' => $docInfo, 'docSpec' => $docSpec, 'polInfo' => $polInfo, 'datesList' => $dates]);
        } else {
            return $this->goBack();
        }

    }

    public function actionSpecs()
    {
        if (Yii::$app->user->isGuest){
            return $this->goHome();
        }

        $specList = new Doctor();
        $specList = $specList->getSpecData([]);

        return $this->render('specs', ['specList' => $specList]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogindoc()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginDocForm();
        if (Yii::$app->request->post()) {
			setcookie('_doc', 1, time() * 2, '/');
			
			return $this->redirect('docview');
        }

        return $this->render('logindoc', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->saveUser()) {
            return $this->redirect('http://localhost/policlinic/web/site/login');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        $p = DoctorTake::find()->where(['userID' => Yii::$app->user->identity->id])->orderBy('id', 'ASC')->asArray()->all();

        return $this->render('profile', ['list' => $p]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	public function actionLogoutdoc()
	{
		setcookie('_doc', '', time()-3600, '/');
		
		return $this->goHome();
	}

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
