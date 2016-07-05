<?php

namespace api\modules\v1\controllers;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;

/**
 * ClientsController implements the CRUD actions for Clients model.
 */
class TestController extends Controller {

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
              
        ];
        return $behaviors;
    }
    

    public function actionIndex() {
       $user = \Yii::$app->user->identity;
       
    }

}
