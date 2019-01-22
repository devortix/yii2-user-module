<?php
namespace devortix\user\models;

use dektrium\user\models\User as UserBase;

class User extends UserBase implements \yii\web\IdentityInterface
{
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }
}