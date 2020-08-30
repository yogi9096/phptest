<?php
namespace app\modules\api\behaviours;
use Yii;
use yii\web\Response;

class Verbcheck extends \yii\filters\VerbFilter
{
    /**
     * @param ActionEvent $event
     * @return boolean
     * @throws MethodNotAllowedHttpException when the request method is not allowed.
     */
    public function beforeAction($event)
    {
        $action = $event->action->id;

        if (isset($this->actions[$action])) {
            $verbs = $this->actions[$action];
        } elseif (isset($this->actions['*'])) {
            $verbs = $this->actions['*'];
        } else {
            return $event->isValid;
        }

        $verb = Yii::$app->getRequest()->getMethod();
        $allowed = array_map('strtoupper', $verbs);
        if (!in_array($verb, $allowed)) {
            $event->isValid = false;
            Yii::$app->response->format = Response::FORMAT_RAW;
            Yii::$app->getResponse()->getHeaders()->set('Allow', implode(', ', $allowed));
            Yii::$app->api->sendFailedResponse('Method Not Allowed. This url can only handle the following request methods: ' . implode(', ', $allowed) . '.');
        }

        return $event->isValid;
    }

}