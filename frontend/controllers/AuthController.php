<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use Firebase\JWT\JWT;

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

    public function actionAuth()
    {
        $requestData = Yii::$app->request->post();
        
        $user = User::findByUsername($requestData['username']);
        
        if ($user && $user->validatePassword($requestData['password'])) {
            $payload = [
                'iat' => time(),
                'exp' => time() + 3600,
                'uid' => $user->id,
            ];
            
            $key = 'burmalda_6767_5252_4747_4242_goooool_pobeda';
            
            $jwt = JWT::encode($payload, $key, 'HS256');
            
            return ['status' => 'success', 'token' => $jwt];
        }
        
        return ['status' => 'error', 'message' => 'Invalid username or password'];
    }
}