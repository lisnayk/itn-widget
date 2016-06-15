<?php
namespace app\controllers\rest;

use yii\rest\ActiveController;

class EventsController extends ActiveController
{
    public $modelClass = 'app\models\Events';
}