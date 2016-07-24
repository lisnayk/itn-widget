<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class JsController extends Controller
{
    public $defaultAction = 'index';
    public function actionApp($key)
    {
        return $this->renderPartial('index', array("key"=>$key));
    }

}
