<?php
/*
 * user.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 * На страницу пользователя ограничение для других пользователей
 * у которых другой id
 * 
 */
class accessuser
{
	function canAccess()
	{
		$userid=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		if($_SESSION['type']=='user' && $userid!=$_SESSION['id'])
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
