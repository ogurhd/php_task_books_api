<?php

namespace frontend\controllers;

use yii\base\Behavior;
use yii\rest\ActiveController;

class BookController extends ActiveController
{
    public $modelClass = 'frontend\models\Book';
    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => \yii\web\Response::FORMAT_JSON,
        ];
        return $behaviors;
    }
}