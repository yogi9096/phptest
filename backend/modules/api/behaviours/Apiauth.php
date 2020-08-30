<?php

namespace app\modules\api\behaviours;

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

//namespace yii\filters\auth;
use Yii;
use yii\filters\auth\AuthMethod;
/**
 * QueryParamAuth is an action filter that supports the authentication based on the access token passed through a query parameter.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Apiauth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    public $tokenParam = 'access-token';

    public $exclude = [];
    public $callback = [];


    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $headers = Yii::$app->getRequest()->getHeaders();

        $accessToken = NULL;
        if (isset($_GET['access_token'])) {
            $accessToken = $_GET['access_token'];
        } else {
            $accessToken = $headers->get('x-access_token');
        }

        if (empty($accessToken)) {

            if (isset($_GET['access-token'])) {
                $accessToken = $_GET['access-token'];
            } else {
                $accessToken = $headers->get('x-access-token');
            }
        }

        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            Yii::$app->api->sendFailedResponse('Invalid Access token');
        }


        return null;
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, $this->exclude) && !isset($_GET['access-token'])) {
            return true;
        }

        if (in_array($action->id, $this->callback) && !isset($_GET['access-token'])) {
            return true;
        }

        $response = $this->response ?: Yii::$app->getResponse();

        $identity = $this->authenticate(
            $this->user ?: Yii::$app->getUser(),
            $this->request ?: Yii::$app->getRequest(),
            $response
        );

        if ($identity !== null) {
            return true;
        } else {
            $this->challenge($response);
            $this->handleFailure($response);
            Yii::$app->api->sendFailedResponse('Invalid Request');
        }
    }

    /**
     * @inheritdoc
     */
    public function handleFailure($response)
    {
        Yii::$app->api->sendFailedResponse('Invalid Access token');
    }
}
