<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
define('DIRSEP', DIRECTORY_SEPARATOR);
if (defined('YII_DEBUG') && YII_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
require_once('/var/www/html/findorsave/vendor/autoload.php');
$yii = '/var/www/html/findorsave/vendor/yiisoft/yii/framework/yii.php';
$config = '/var/www/html/findorsave/application/protected/config/main.php';
require_once($yii);
Yii::createWebApplication($config)->run();
