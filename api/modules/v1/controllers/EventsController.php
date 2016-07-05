<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class EventsController extends ActiveController {

    public $modelClass = 'app\models\Events';

    public function actions() {
        $actions = parent::actions();
        unset($actions['options']);
        unset($actions['post']);
        return $actions;
    }

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            //"except" => ['get','options'], //"delete", "create", "update"],
            //'only'=>['GET','POST'],
        ];
        
        /* $behaviors['verbs'] = [
          'class' => \yii\filters\VerbFilter::className(),
          'actions' => [
          'index' => ['get'],
          'view' => ['get'],
          'options' => ['options'],
          "*" => [''],
          /* 'view' => ['get'],
          'create' => ['get', 'post'],
          'update' => ['get', 'put', 'post'],
          'delete' => ['post', 'delete'],
          ],
          ]; */



        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = []) {
        $user = \Yii::$app->user->identity;
        if (!isset($user) || $user->status_id != 1) {
            throw new \yii\web\ForbiddenHttpException("User is disabled!");
        }
    }

    public function actionOptions() {
        echo "Api description!";
    }

}
