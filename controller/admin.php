<?php
/*
 * admin.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 * Не разрешает доступ на страницу других админов, с другим id
 * 
 * 
 */
class accessadmin
{
	function canAccess()
	{
		$userid=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT, ['options'=>['default'=>$_SESSION['id']]]);
		if($_SESSION['type']=='admin' && $userid!=$_SESSION['id'])
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
?>

