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
