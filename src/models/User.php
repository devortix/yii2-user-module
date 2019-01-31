<?php
namespace devortix\user\models;

use dektrium\user\models\User as UserBase;

class User extends UserBase implements \yii\web\IdentityInterface
{
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = static::findOne(['auth_key' => $token]);
        if ($user) {
            return $user;
        }

        throw new \yii\web\HttpException(401, 'User not found!');
    }
}