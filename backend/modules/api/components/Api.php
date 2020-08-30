<?php

namespace app\modules\api\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use app\models\User;
use yii\web\Response;
//use app\models\AuthorizationCodes;
//use app\models\AccessTokens;

/**
 * Class for common API functions
 */
class Api extends Component
{
    public function sendFailedResponse($message)
    {
        $this->setHeader(400);
        echo json_encode(array('status' => 0, 'error_code' => 400, 'errors' => $message), JSON_PRETTY_PRINT);
        Yii::$app->end();
    }

    public function sendSuccessResponse($data = false, $additional_info = false)
    {
        $this->setHeader(200);
        $response = [];
        $response['status'] = 1;

        if (is_array($data)) {
            $response['data'] = $data;
        }

        if ($additional_info) {
            $response = array_merge($response, $additional_info);
        }
        $response = Json::encode($response, JSON_PRETTY_PRINT);

        if (isset($_GET['callback'])) {
            /* this is required for angularjs1.0 client factory API calls to work */
            $response = $_GET['callback'] . "(" . $response . ")";
            echo $response;
        } else {
            echo $response;
        }
        Yii::$app->end();
    }

    protected function setHeader($status)
    {
        $text = $this->_getStatusCodeMessage($status);
        Yii::$app->response->setStatusCode($status, $text);
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $text;
        header($status_header);
        header('Content-type: application/json; charset=utf-8');
        header('X-Powered-By: ' . "Your Company <www.mywebsite.com>");
        header('Access-Control-Allow-Origin:*');
        Yii::$app->response->format = Response::FORMAT_RAW;
    }

    protected function _getStatusCodeMessage($status)
    {
        $codes = array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }
}
