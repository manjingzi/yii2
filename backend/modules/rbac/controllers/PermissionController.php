<?php

namespace backend\modules\rbac\controllers;

use Yii;
use backend\controllers\BaseController;

class PermissionController extends BaseController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreate() {
        return $this->render('create');
    }

}
