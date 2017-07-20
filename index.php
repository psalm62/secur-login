<?php
/*
 * index.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */


//~  Константа для доступа к config.php, проверяется ее наличие в нем, 
//~ чтобы нельзя было получить доступ к config.php напрямую
define('testPage', 1);

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
