<?php
/*
 * model.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
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
	public function getDataForSendCode($login)
	{
		$stmt=$this->dbh->prepare(
			'SELECT `email`,`id` FROM `reg_user` WHERE `login`=:login'
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
	public function writeCodeBase($cod, $id)
	{
		$stmt=$this->dbh->prepare(
			'SELECT * FROM `recovery` 
			WHERE `id`=:id'
		);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		if($row=$stmt->fetch())
		{
			$stmt=$this->dbh->prepare(
				'DELETE FROM `recovery`
				WHERE `id`=:id'
			);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}
		$stmt=$this->dbh->prepare(
			'INSERT INTO `recovery`(`id`,`code`)
			VALUES (:id, :cod)'
		);
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':cod', $cod);
		$res=$stmt->execute();
		
		return $res;
	}
	public function getIdOnCode($code)
	{
		$stmt=$this->dbh->prepare(
			'SELECT `id` FROM `recovery` WHERE `code`=:code'
		);
		$stmt->bindValue(':code', $code);
		$stmt->execute();
		if($row=$stmt->fetch())
		{
			$stmt=$this->dbh->prepare(
				'DELETE FROM `recovery`
				WHERE `id`=:id'
			);
			$stmt->bindValue(':id', $row['id']);
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
	public function newPass($id, $pass)
	{
		$stmt=$this->dbh->prepare(
			'UPDATE `reg_user`
			SET `pass`=:pass
			WHERE `id`=:id'
		);
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':pass', $pass);
		$res=$stmt->execute();
		
		return $res;
	}
	public function sendSupport($name, $email, $quest, $id)
	{
		$stmt=$this->dbh->prepare(
			'INSERT INTO `questions`(`name`,`email`,`ques`, `userid`)
			VALUES (:name, :email, :ques, :id)'
		);
		$stmt->bindValue(':name', $name);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':ques', $quest);
		$stmt->bindValue(':id', $id);
		$res=$stmt->execute();
		
		return $res;
	}
	public function getLoginCount($hash)
	{
		$stmt=$this->dbh->prepare(
			'SELECT `count`,`time` FROM `dostup` WHERE `hash`=:hash'
		);
		$stmt->bindValue(':hash', $hash);
		$stmt->execute();
		$row=$stmt->fetch();
		return $row;
	}
	public function createLoginCount($count, $hash, $login)
	{
		$stmt=$this->dbh->prepare(
			'INSERT INTO `dostup`(`count`,`hash`,`login`)
			VALUES (:count, :hash, :login)'
		);
		$stmt->bindValue(':count', $count);
		$stmt->bindValue(':hash', $hash);
		$stmt->bindValue(':login', $login);
		$stmt->execute();
	}
	public function updateLoginCount($hash, $count)
	{
		$stmt=$this->dbh->prepare(
			'UPDATE `dostup` SET `count`=:count
			WHERE `hash`=:hash'
		);
		$stmt->bindValue(':hash', $hash);
		$stmt->bindValue(':count', $count);
		$stmt->execute();
	}
	public function delLoginCount($login)
	{
		$stmt=$this->dbh->prepare(
			'DELETE FROM `dostup` WHERE `login`=:login'
		);
		$stmt->bindValue(':login', $login);
		$stmt->execute();
	}
	public function testNewLogin($login)
	{
		$stmt=$this->dbh->prepare(
			'SELECT * FROM `reg_user` WHERE `login`=:login'
		);
		$stmt->bindValue(':login', $login);
		$stmt->execute();
		if($row=$stmt->fetch())
		{
			return $row;
		}
		
		
	}
	public function createNewLogin($id, $login)
	{
		$stmt=$this->dbh->prepare(
			'UPDATE `reg_user`
			SET `login`=:login
			WHERE `id`=:id'
		);
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':login', $login);
		$res=$stmt->execute();
		
		return $res;
	}
	public function createNewEmail($id, $email)
	{
		$stmt=$this->dbh->prepare(
			'UPDATE `reg_user`
			SET `email`=:email
			WHERE `id`=:id'
		);
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':email', $email);
		$res=$stmt->execute();
		
		return $res;
	}
	public function searchUserData($data)
	{
		if($data==null)
		{
			$stmt=$this->dbh->prepare(
				'SELECT * FROM `reg_user`'
			);
		}
		elseif(count($data)==1)
		{
			foreach ($data as $key => $value)
			{
				$dop=' WHERE `'.$key.'`=:'.$key;
			}
			$stmt=$this->dbh->prepare(
				'SELECT * FROM `reg_user`'.$dop 
			);
			$stmt->bindValue(':'.$key, $value);
		}
		else
		{
			$stmt=$this->dbh->prepare(
				'SELECT * FROM `reg_user`WHERE `login`=:login AND `email`=:email' 
			);
			$stmt->bindValue(':login', $data['login']);
			$stmt->bindValue(':email', $data['email']);
		}
		
		$stmt->execute();
		while($dat=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$row[]=$dat;
		}
		return $row;
		
	}
	public function newUserType($id, $type)
	{
		$stmt=$this->dbh->prepare(
			'UPDATE `reg_user` SET `type`=:type WHERE `id`=:id'
		);
		$stmt->bindValue(':type', $type);
		$stmt->bindValue(':id', $id);
		$stmt->execute();

	}
	public function newUserStatus($id, $status)
	{
		$stmt=$this->dbh->prepare(
			'UPDATE `reg_user` SET `status`=:status WHERE `id`=:id'
		);
		$stmt->bindValue(':status', $status);
		$stmt->bindValue(':id', $id);
		$stmt->execute();

	}
	public function deleteUser($id)
	{
		$stmt=$this->dbh->prepare(
			'DELETE FROM `reg_user` WHERE `id`=:id'
		);
		$stmt->bindValue(':id', $id);
		$stmt->execute();

	}
	public function getMessages($id)
	{
		if($id==null)
		{
			$stmt=$this->dbh->prepare(
				'SELECT * FROM `questions`'
			);
		}
		else
		{
			$stmt=$this->dbh->prepare(
				'SELECT * FROM `questions` WHERE `userid`=:id'
			);
			$stmt->bindValue(':id', $id);
		}
		$stmt->execute();
				
		while($dat=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			$data[]=$dat;
		}
		return $data;
	}
	public function deleteMess($id)
	{
		$stmt=$this->dbh->prepare(
			'DELETE FROM `questions` WHERE `id`=:id'
		);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}
}
?>
