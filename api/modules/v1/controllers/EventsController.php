<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use api\modules\v1\traits\ApiAccess;
/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class EventsController extends \yii\rest\ActiveController {
    
    use ApiAccess;

    public $modelClass = 'app\models\Events';

    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            "except" => ['options'],
        ];

        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'index' => ['get'],
                'view' => ['get'],
                'options' => ['options'],
                "*" => [''],
            ]
        ];
        return $behaviors;
    }

}
