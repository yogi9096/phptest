<?php

namespace app\modules\api\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\api\behaviours\Verbcheck;
use app\modules\api\behaviours\Apiauth;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors + [
            'verbs' => [
                'class' => Verbcheck::className(),
                'actions' => [
                    'logout' => ['POST'],
                    'authorize' => ['POST'],
                    'register' => ['POST'],                 
                    'accesstoken' => ['POST'],
                    'resetpassword' => ['POST'],
                    'index' => ['get'],
                ],
            ],
        ];
    }
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->api->sendSuccessResponse(['Yii2 RESTful API with OAuth2']);
    }
}
