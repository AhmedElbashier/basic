<?php

namespace app\controllers;

use app\models\ApiResult;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Result;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
        return $this->render('index');
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
    public function actionIndexResult()
    {
        return $this->render('result');
    }
    public function actionResult()
{
    // $dataProvider = new \yii\data\ArrayDataProvider([
    //     'allModels' => [
    //         [
    //             'id' => 1,
    //             'date' => '2022-01-01',
    //             'hours' => 5,
    //             'start' => '09:00',
    //             'numberOfLines' => 10,
    //             'result' => 'success',
    //         ],
    //         [
    //             'id' => 2,
    //             'date' => '2022-01-02',
    //             'hours' => 4,
    //             'start' => '10:00',
    //             'numberOfLines' => 8,
    //             'result' => 'failure',
    //         ],
    //         [
    //             'id' => 3,
    //             'date' => '2022-01-03',
    //             'hours' => 6,
    //             'start' => '11:00',
    //             'numberOfLines' => 12,
    //             'result' => 'success',
    //         ],
    //         [
    //             'id' => 4,
    //             'date' => '2022-01-04',
    //             'hours' => 7,
    //             'start' => '12:00',
    //             'numberOfLines' => 15,
    //             'result' => 'success',
    //         ],
    //     ],
    //     'pagination' => [
    //         'pageSize' => 10,
    //     ],
    // ]);

    $dataProvider = new ActiveDataProvider([
        'query' => Result::find(),
    ]);
    return $this->render('result', [
        'dataProvider' => $dataProvider,
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