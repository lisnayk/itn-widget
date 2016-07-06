<?php

namespace api\modules\v1\controllers;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use api\modules\v1\traits\ApiAccess;

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
