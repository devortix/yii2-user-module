<?php
namespace devortix\user\controllers;

use dektrium\user\models\LoginForm;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\Response;

class ApiController extends ActiveController
{
    public $modelClass = 'dektrium\user\models\User';
    public function beforeAction($action)
    {
        \Yii::$app->user->enableSession = false;

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'Origin' => ['*'],
            'Access-Control-Expose-Headers' => [],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        unset($behaviors['authenticator']);
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['authenticator']['except'] = ['login'];
        return $behaviors;
    }

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function actionLogin()
    {
        $model = \Yii::createObject(LoginForm::className());
        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');
        $model->login = $username;
        $model->password = $password;

        if ($model->login()) {

            return [
                'token' => \Yii::$app->getUser()->identity->auth_key,
            ];
        }

        throw new \yii\web\HttpException(401, 'User not found!');
    }

    public function actionToken()
    {

        if (\Yii::$app->getUser()) {
            return [
                'user' => [
                    'username' => \Yii::$app->getUser()->identity->username,
                    'token' => \Yii::$app->getUser()->identity->auth_key,
                ],
            ];
        }

    }

}