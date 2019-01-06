<?php

namespace devortix\user;

/**
 * main module definition class
 */
class Module extends \dektrium\user\Module
{
    public $loginLayout = '@vendor/devortix/yii2-admin-module/src/views/layouts/login.php';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'dektrium\user\controllers';
    public $controllerMap = [
        'api' => 'devortix\user\controllers\ApiController',
    ];
    public $viewPath = '@vendor/dektrium/yii2-user/views';
    // public $layoutPath = '@vendor/dektrium/yii2-user/views'

    /**
     * {@inheritdoc}
     */

    public function beforeAction($action)
    {
        if (in_array($action->id, ['login', 'resend', 'register', 'forgot', 'request', 'reset', 'confirm'])) {
            $action->controller->layout = $this->loginLayout;
        }
        return parent::beforeAction($action);
    }
    public function init()
    {
        $this->setViewPath('@vendor/dektrium/yii2-user/views');
        parent::init();

    }
}