<?php

namespace frontend\controllers;

use Yii;
use common\models\User;

class AuthController extends \yii\rest\Controller
{
    public function actionRegister()
    {
        $requestData = Yii::$app->request->post();
        
        $user = new User();
        $user->username = $requestData['username'];
        $user->email = $requestData['email'];
        
        $user->status = 10; 
        
        $user->setPassword($requestData['password']);
        $user->generateAuthKey();
        
        if ($user->save()) {
            return ['status' => 'success', 'id' => $user->id];
        }
        
        return ['status' => 'error', 'errors' => $user->errors];
    }
}