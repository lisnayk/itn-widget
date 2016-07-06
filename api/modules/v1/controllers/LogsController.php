<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use api\modules\v1\traits\ApiAccess;
use app\models\Logs;
use Yii;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

class LogsController extends ActiveController {

    use ApiAccess;

    public $modelClass = 'app\models\Logs';

    public function actions() {
        // Override Index action
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            "except" => ['options'],
        ];
        return $behaviors;
    }

    public function actionCreate() {
        $model = new Logs();
        $user = Yii::$app->user->identity;

        $model->load(Yii::$app->getRequest()->getBodyParams(), "");

        $request = Yii::$app->getRequest();
        $model->client_id = $user->id;
        $model->httpAgent = $request->userAgent;
        $model->remoteHost = $request->serverName;
        $model->remoteIp = $request->userIP;
        $model->remotePort = "" . $request->serverPort;
        $model->romoteAddr = $request->absoluteUrl;

        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(["view", 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
    }

}
