<?php
/*
 * model.php
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
class model
{
	protected $dbh;
	private static $instance=null;
	
	private function __construct()
	{
		global $dbName, $dbHost, $dbUser, $dbPass;
		try
		{
			$this->dbh=new PDO("mysql:dbname={$dbName};dbhost={$dbHost}", $dbUser, $dbPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		}
		catch (PDOException $e)
		{
			echo '<p>Не получилось подключиться к базе</p>';
			die();
		}
		
	}
	public static function getInstance()
	{
		if(self::$instance==null)
		{
			self::$instance=new model();
		}
		return self::$instance;
	}
	public function testUser($login, $pass)
	{
		$stmt=$this->dbh->prepare(
			"SELECT * FROM `reg_user` WHERE `login`=:login"
		);
		$stmt->bindValue(':login', $login);
		$stmt->execute();
		if(($row=$stmt->fetch()) && password_verify($pass, $row['pass']))
		{
			return $row;
		}
		else
		{
			return false;
		}
	}
	public function regUser($login, $pass, $email, $iv)
	{
		$stmt=$this->dbh->prepare(
			'INSERT INTO `reg_user`(`login`,`pass`,`email`,`iv`)
			VALUES (:login, :pass, :email, :iv)'
		);
		$stmt->bindValue(':login', $login);
		$stmt->bindValue(':pass', $pass);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':iv', $iv);
		$res=$stmt->execute();
		
		return $res;
	}
	public function getLogin($email)
	{
		$stmt=$this->dbh->prepare(
			'SELECT `login` FROM `reg_user` WHERE `email`=:email'
		);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		if($row=$stmt->fetch())
		{
			return $row;
		}
		else
		{
			return false;	
		}
	}
	public function getEmailForSendCode($login)
	{
		$stmt=$this->dbh->prepare(
			'SELECT `email` FROM `reg_user` WHERE `login`=:login'
		);
		$stmt->bindValue(':login', $login);
		$stmt->execute();
		if($row=$stmt->fetch())
		{
			return $row;
		}
		else
		{
			return false;	
		}
	}
	public function writeCodeBase($cod, $login)
	{
		$stmt=$this->dbh->prepare(
			'SELECT * FROM `recovery` 
			WHERE `login`=:login'
		);
		$stmt->bindValue(':login', $login);
		$stmt->execute();
		if($row=$stmt->fetch())
		{
			$stmt=$this->dbh->prepare(
				'DELETE FROM `recovery`
				WHERE `login`=:login'
			);
			$stmt->bindValue(':login', $login);
			$stmt->execute();
		}
		$stmt=$this->dbh->prepare(
			'INSERT INTO `recovery`(`login`,`code`)
			VALUES (:login, :cod)'
		);
		$stmt->bindValue(':login', $login);
		$stmt->bindValue(':cod', $cod);
		$res=$stmt->execute();
		
		return $res;
	}
	public function getLoginOnCode($code)
	{
		$stmt=$this->dbh->prepare(
			'SELECT `login` FROM `recovery` WHERE `code`=:code'
		);
		$stmt->bindValue(':code', $code);
		$stmt->execute();
		if($row=$stmt->fetch())
		{
			$stmt=$this->dbh->prepare(
				'DELETE FROM `recovery`
				WHERE `login`=:login'
			);
			$stmt->bindValue(':login', $row['login']);
			$res=$stmt->execute();
			if($res)
			{
				return $row;
			}
			else
			{
				echo "Попробуйте позже это сделать";
				die();
			}
		}
		else
		{
			return false;	
		}
	}
	public function newPass($login, $pass)
	{
		$stmt=$this->dbh->prepare(
			'UPDATE `reg_user`
			SET `pass`=:pass
			WHERE `login`=:login'
		);
		$stmt->bindValue(':login', $login);
		$stmt->bindValue(':pass', $pass);
		$res=$stmt->execute();
		
		return $res;
	}
	public function sendSupport($name, $email, $quest)
	{
		$stmt=$this->dbh->prepare(
			'INSERT INTO `questions`(`name`,`email`,`ques`)
			VALUES (:name, :email, :ques)'
		);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':ques', $quest);
		$res=$stmt->execute();
		
		return $res;
	}
}
?>
