<?php

namespace App\Presenters;

//use Nette\Security\User;


class HomepagePresenter extends BasePresenter
{
	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
                
                if ($this->getUser()->isLoggedIn()) 
                {
                    $this->template->uzivatel= $this->getUser()->getIdentity()->username;
                } else {
                    $this->template->uzivatel='';
                }
                
	}
        
        public function actionKrizovatka(){
            if($this->getUser()->isLoggedIn())
                $this->redirect ('Homepage:hlavni');
            else
                $this->redirect ('Sign:in');
        }


        /*
        public function actionOut()
	{
		$this->getUser()->logout();
                //redirect('Sing: ');
	}
         * 
         */
}
