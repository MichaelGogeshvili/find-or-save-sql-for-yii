<?php
// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
    //'theme'=>'bootstrap',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'findorsave',
    'theme' => 'findorsave',
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'secret',
            'ipFilters'=>array('127.0.0.1'),
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
              'connectionString' => 'mysql:host=localhost;dbname=findorsave',
              'emulatePrepare' => true,
              'username' => 'root',
              'password' => '',
              'tablePrefix' => 'tbl_',
              'emulatePrepare' => true,
              'charset' => 'utf8',
              'enableParamLogging' => true,
              'enableProfiling' => true,
        ),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
    ),
);
