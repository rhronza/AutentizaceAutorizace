<?php

namespace App\Presenters;

use App\Forms;
use Nette\Application\UI\Form;


class SignPresenter extends BasePresenter
 {
	/** @var Forms\SignInFormFactory */
	private $signInFactory;

	/** @var Forms\SignUpFormFactory */
	private $signUpFactory;
        
        private $changePasswordFormFactory;


        public function __construct(Forms\SignInFormFactory $signInFactory, 
                                    Forms\SignUpFormFactory $signUpFactory ,
                                    Forms\ChangePasswordFormFactory $changePasswordFormFactory)
	{
		$this->signInFactory = $signInFactory;
		$this->signUpFactory = $signUpFactory;
                $this->changePasswordFormFactory=$changePasswordFormFactory;
	}


	/**
	 * Sign-in form factory.
	 * @return Form
	 */
	protected function createComponentSignInForm()
	{
            $form=$this->signInFactory->create(function () {$this->redirect('Homepage:hlavni');});
            return $form;
	}


	/**
	 * Sign-up form factory.
	 * @return Form
	 */
	protected function createComponentSignUpForm()
	{
		return $this->signUpFactory->create(function () {
			$this->redirect('Homepage:hlavni');
		});
	}
        
        protected function createComponentChangePasswordForm() {
            $form= $this->changePasswordFormFactory->create( function (){$this->redirect('Homepage:hlavni');});
            return $form;
        }


	public function actionOut()
	{
		$this->getUser()->logout();
	}
}
