<?php
/*
 * index.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * 
 */


//~  Константа для доступа к config.php, проверяется ее наличие в нем, 
//~ чтобы нельзя было получить доступ к config.php напрямую
define('testPage', 1);

require_once('recaptchalib.php');
require_once('config.php');
require_once('view/view.php');
require_once('controller/controller.php');
require_once('model/model.php');
require_once('controller/access.php');

session_start();

$namecontr=filter_input(INPUT_POST, 'nameCtr', FILTER_SANITIZE_SPECIAL_CHARS);
if (empty($namecontr))
{
	$namecontr='display';
}
$controller=new controller();
$controller->$namecontr();
?>	
