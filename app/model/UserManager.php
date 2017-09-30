<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
//use Nette\Security\User;


/**
 * Users management.
 */
class UserManager implements Nette\Security\IAuthenticator
{
	use Nette\SmartObject;

	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'username',
		COLUMN_PASSWORD_HASH = 'password',
		COLUMN_EMAIL = 'email',
		COLUMN_ROLE = 'role';


	/** @var Nette\Database\Context */   
	private $database;
	
        //private $user;
        


	public function __construct(Nette\Database\Context $database /*, User  $user*/)
	{
		$this->database = $database;
                //$this->user = $user;
	}


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	
        public function authenticate(array $credentials)
	{
	
            list($username, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)
			->where(self::COLUMN_NAME, $username)
			->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('Uživatelské jméno není správné.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('Heslo není správné.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update([
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			]);
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
         
	}
        

	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return void
	 * @throws DuplicateNameException
	 */
	public function add($username, $email, $password)
	{
		try {
			$this->database->table(self::TABLE_NAME)->insert([
				self::COLUMN_NAME => $username,
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
				self::COLUMN_EMAIL => $email,
			]);
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
                      throw new DuplicateNameException;
		}
	}
        
        public function changePassword( $zznUzivatele, $newPassword) {
            $pocetZaznamu=$this->database->table(self::TABLE_NAME
                    )->where('id', $zznUzivatele->id)
                    -> update(['password'=> Passwords::hash($newPassword)]);
            if ($pocetZaznamu === 0) {
                ?> <script> alert('Heslo nebylo změněno !!!'); </script> <?php
            }
            if ($pocetZaznamu>1) {
                ?> <script> alert('Bylo změněno více hesel. Program bude ukončen'); </script> <?php
                die;
            }
        }
        
        public function getPassword($id) {
                $zznUzivatele= $this->database->table('users')->get($id);
                if($zznUzivatele) {
                    return $zznUzivatele; 
                } else {
                    echo 'Uživatel nenalezen. Chyba 52-36-74-19.'.'<br/>';
                    echo 'Pokoušíte se měnit heslo u neznámého uživatele.'.'<br/>';
                    echo 'Program z bezpečnostních důvodů ukončen.'.'<br/>';
                    echo 'Přihlaste se znovu.'.'<br/>'; 
                    die;
                }
        }
        
        
        
        
        public function MetodaNaNicPrazdna(){
        }
}



class DuplicateNameException extends \Exception
{
    
}
