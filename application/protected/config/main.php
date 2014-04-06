<?php
// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
defined('DIRSEP') || define ('DIRSEP', '/');
return array(
    //'theme'=>'bootstrap',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'findorsave',
    'theme' => 'findorsave',
    'onBeginRequest' => function($event) {
        $additionalRoutes = array();

        foreach (Yii::app()->getModules() as $module) {
            if (isset($module['routes'])) {
                array_walk($module['routes'], function($value) use(&$additionalRoutes){
                    $additionalRoutes = array_merge($additionalRoutes, $value);
                });
            }
        }

        Yii::app()->urlManager->addRules($additionalRoutes);
    },

    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.modules.android.*',
    ),

    'aliases' => array(
        'vendor' => dirname(__FILE__) . DIRSEP . '..' . DIRSEP . '..' . DIRSEP . '..' . DIRSEP . 'vendor',
        'widgets' => 'application.components.widgets',
        'widgets.PhonesWidget' => 'widgets.PhonesWidget.PhonesWidget',
        'widgets.SortingDataWidget' => 'widgets.SortingDataWidget.SortingDataWidget',
        'widgets.InterkassaWidget' => 'widgets.InterkassaWidget.InterkassaWidget',
    ),
    'modules'=>array(
        //  modules go here,
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'secret',
            'ipFilters'=>array('127.0.0.1','::1'),
            'newFileMode'=>0666,
            'newDirMode'=>0777,
            'generatorPaths'=>array( 'bootstrap.gii', ),

                        // 'ipFilters'=>array(…список IP…),
                        // 'newFileMode'=>0666,
                        // 'newDirMode'=>0777,
        ),
    ),
    'components'=>array(
        'db'=> array ( 
            'connectionString' => 'mysql:host=localhost;port=3307;dbname=findorsave',
            'tablePrefix' => 'findorsave_',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableParamLogging' => true,
            'enableProfiling' => true,
        ),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
    ),
    'params' => array(
        'adminEmail' => 'm.gogeshvili@gmail.com',
        'GCM_URL' => 'https://android.googleapis.com/gcm/send',
        'GCM_KEY' => 'AIzaSyBUnGw00PjzCjd4v61125Xe795Iq7s8uVA',
        'PLAN_TABLE' => array(
            0 => array( 'name' => 'Plan IX', 'USD_PER_START' => 0.1, 'USD_PER_MONTH' => 0.1,),
            1 => array( 'name' => 'Plan IV', 'USD_PER_START' => 0.2, 'USD_PER_MONTH' => 0.2,),
        ),
    ),
);
