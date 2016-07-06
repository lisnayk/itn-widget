<?php

namespace api\modules\v1\traits;

use yii\web\ForbiddenHttpException;

trait ApiAccess {

    public function checkAccess($action, $model = null, $params = []) {
        $user = \Yii::$app->user->identity;
        if (!isset($user) || $user->status_id != 1) {
            throw new ForbiddenHttpException("User is disabled!");
        }
    }

}
