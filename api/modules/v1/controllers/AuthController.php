<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use api\modules\v1\models\Clients;

/**
 * AuthController implements the CRUD actions for Clients model.
 */
class AuthController extends ActiveController {

    public $modelClass = 'api\modules\v1\models\Clients';

    public function actions() {
        // Override Index action
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

   /* public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'index' => ['GET'],
                'options' => ['options'],
                "*" => ['get'], 
          
            ],
        ];
        return $behaviors;
    }*/

    public function actionIndex($appKey) {
       
        $user = Clients::findOne(['auth_key' => $appKey]);
        if (isset($user) && $user->status_id == 1) {
            return $user;
        } else {
            throw new \yii\web\ForbiddenHttpException("User is not found or disabled");
        }
    }

}
