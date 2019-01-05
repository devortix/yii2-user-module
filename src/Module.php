<?php

namespace devortix\user;

/**
 * main module definition class
 */
class Module extends \dektrium\user\Module
{
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
    public function init()
    {
        $this->setViewPath('@vendor/dektrium/yii2-user/views');
        parent::init();

    }
}