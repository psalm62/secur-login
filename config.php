<?php

//~ Проверяем что config.php вызван из index.php а не напрямую
if (!defined('testPage'))
{
	http_response_code(404);
	readfile('view/404.php');
	die();
}


$dbUser='reglogin';
$dbPass='reglogin';
$dbHost='localhost';
$dbName='reglogin';

//~ Переменные получены с помощью generate.php
$dbGlobalKey = base64_decode('zgxMqH8DffPE7jRDp/9n5Q==');
$dbGlobalIv = base64_decode('S8asG/vIhQlo8HDT1T3Tvw==');
$dbA = 'aes-256-cbc';
