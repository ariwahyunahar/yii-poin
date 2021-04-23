<?php

ini_set( 'date.timezone', 'Asia/Jakarta' );

function dd($par = array()){
    echo '<pre>';print_r($par);die();
}


/*
define("PAYMS_SERVER_ENCR", "http://payment.mdmedia.co.id/paym/encr?par=");
// MTU7QkhN___MTw8PUxHUFZgW2RqdA==___ZjtrdUdJUoSMY2qan3mor7GJk8LJnKalsN606vHKxv0=
define("PAYMS_SERVER_REG", "http://payment.mdmedia.co.id/paym/registrasisession?p=");
// MTU7QkhN___ZjtrdUdJUoSMY2qan3mor7GJk8LJnKalsN606vHKxv0=
define("PAYMS_SERVER_GET", "http://payment.mdmedia.co.id/paym/pay?p=");

define("PAYMS_SERVER_BON_PERIOD", "http://payment.mdmedia.co.id/paym/bnsperiod?p=");
define("PAYMS_SERVER_BON", "http://payment.mdmedia.co.id/paym/bns?p=");
*/

// new server
$server_paym = 'http://172.19.28.108:8888';
// old server
// $server_paym = 'http://172.19.28.107:8888';

define("PAYMS_SERVER_ENCR", $server_paym. "/paym/encr?par=");
// MTU7QkhN___MTw8PUxHUFZgW2RqdA==___ZjtrdUdJUoSMY2qan3mor7GJk8LJnKalsN606vHKxv0=
define("PAYMS_SERVER_REG", $server_paym. "/paym/registrasisession?p=");
// MTU7QkhN___ZjtrdUdJUoSMY2qan3mor7GJk8LJnKalsN606vHKxv0=
define("PAYMS_SERVER_GET", $server_paym. "/paym/pay?p=");

define("PAYMS_SERVER_BON_PERIOD", $server_paym. "/paym/bnsperiod?p=");
define("PAYMS_SERVER_BON", $server_paym. "/paym/bns?p=");
define("PAYMS_SERVER", $server_paym);



// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$assets=dirname(__FILE__).'/assets/';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',1);

require_once($yii);
Yii::createWebApplication($config)->run();

