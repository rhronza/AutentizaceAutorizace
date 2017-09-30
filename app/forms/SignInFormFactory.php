<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;


class SignInFormFactory
{
	use Nette\SmartObject;

	/** @var FormFactory */
	private $factory;

	/** @var User */
	private $user;


	public function __construct(FormFactory $factory, User $user)
	{
		$this->factory = $factory;
		$this->user = $user;
	}


	/**
	 * @return Form
	 */
	public function create(callable $onSuccess)
	{;  
		$form = $this->factory->create();
		$form->addText('username', 'Uživatelské jméno:')
			->setRequired('Zadejte prosím své uživatelské jméno.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Zadejte prosím heslo ke svému účtu');

		$form->addCheckbox('remember', 'Zůstat trvale přihlášen');

		$form->addSubmit('send', ' Přihlásit se ')->setAttribute('style','margin-top: 10px; padding:10px; border-radius: 7px');

		$form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
			try {
				$this->user->setExpiration($values->remember ? '14 days' : '30 minutes');
				$this->user->login($values->username, $values->password);
			} catch (Nette\Security\AuthenticationException $e) {
                                $zprava=$e->getMessage();
				//$form->addError('Uživatelské jméno nebo heslo je chybné.');
				$form->addError($zprava);
				return;
			}
			$onSuccess();
		};
                
                

		return $form;
	}
        /*
        public function getUser(): User {
            return $this->user;
        }
         * 
         */


}
