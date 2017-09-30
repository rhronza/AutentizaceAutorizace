<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;
//use Nette\Application\UI\Control;



/**
 * Description of ChangePassword
 *
 * @author Roman Hronza
 */
class ChangePasswordFormFactory {
    
    const PASSWORD_MIN_LENGTH=10;
    
    private $factory;
    private $user;
    private $userManager;
      
    public function __construct(FormFactory $factory, 
                                User $user, 
                                \App\Model\UserManager $userManager ) {
        $this->factory=$factory;
        $this->user=$user;
        $this->userManager=$userManager;
    }

    public function create(callable $kamDale) {
        $form = $this->factory->create();
        $form->addPassword('oldPassword','Současné heslo: ')->setRequired('Zadejte prosím současné heslo');
        $form->addPassword('newPassword1','Nové heslo: ')->setRequired('Zadejte prosím nové heslo')
             ->setOption('description', sprintf('aspoň %d znaků', self::PASSWORD_MIN_LENGTH))   
             ->addRule($form::MIN_LENGTH, 'Délka hesla musí být aspoň %d znaků', self::PASSWORD_MIN_LENGTH);
        $form->addPassword('newPassword2','Zopakujte prosím nové heslo: ')->setRequired('Zopakujte prosím nové heslo')
             ->setOption('description', sprintf('aspoň %d znaků', self::PASSWORD_MIN_LENGTH))   
             ->addRule($form::MIN_LENGTH, 'Délka hesla musí být aspoň %d znaků', self::PASSWORD_MIN_LENGTH);
        $form->addSubmit('send','Změnit heslo');
        
        /* obsluha submit */
        $form->onSuccess[]= function (Form $form, $values) use ($kamDale){
            if ($this->user->isLoggedIn()){
                $zznUzivatele= $this->userManager->getPassword($this->user->getId());
                if (\Nette\Security\Passwords::verify($values->oldPassword, $zznUzivatele->password)){
                    if ($values->newPassword1 == $values->newPassword2) {
                        if($values->newPassword1 != $values->oldPassword){
                            // provedení změny:
                            $this->userManager->changePassword($zznUzivatele, $values->newPassword1);
                            
                        } else {
                            $form['oldPassword']->addError('Původní a nové heslo se musí lišit.');
                            return;
                        }
                    } else {
                        $form['newPassword1']->addError('Nesouhlasí nové heslo');
                        return;
                    }
                } else {
                   $form['oldPassword']->addError('Nesouhlasí současné heslo'); 
                   return;
                }
                $kamDale();
            } else {
                echo 'Uživatel není přihlášen. Chyba 45-78-96-51.'.'<br/>';
                echo 'Pokoušíte se měnit heslo a nejste přihlášen do systému.'.'<br/>';
                echo 'Program z bezpečnostních důvodů ukončen.'.'<br/>';
                echo 'Přihlaste se znovu.'.'<br/>'; 
                die;
            }
        };
        /* konec obsluhy submit */
        return $form;
        
    }
}
