<?php

$DATABASE_CONNECTION_SETTINGS = array (
                                          'connectionString' => 'mysql:host=localhost;dbname=findorsave',
                                          'emulatePrepare' => true,
                                          'username' => 'root',
                                          'password' => '',
                                          'tablePrefix' => 'lsph_',
                                          'emulatePrepare' => true,
                                          'charset' => 'utf8',
                                          'enableParamLogging' => true,
                                          'enableProfiling' => true,);

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'findorsave',
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
    // application components
    'components' => array(
        'db' => $DATABASE_CONNECTION_SETTINGS,

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',


                    /** trace: этот уровень используется методом Yii::trace. Он предназначен для отслеживания процесса выполнения приложения в ходе разработки; */

                    /** info: этот уровень предназначен для протоколирования информации общего характера; */

                    /** profile: данный уровень используется для профилирования (измерения) производительности; */

                    /** warning: этот уровень предназначен для сообщений-предупреждений; */

                    /** error: этот уровень используется для сообщений о критических ошибках. */

                    'levels' => 'error, warning, info, trace',
                ),
            ),
        ),
    ),
);
