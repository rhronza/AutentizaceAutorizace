<?php

namespace App\Forms;

use App\Model;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;


class SignUpFormFactory
{
    use Nette\SmartObject;

    const PASSWORD_MIN_LENGTH = 10;

    /** @var FormFactory */
    private $factory;

    /** @var Model\UserManager */
    private $userManager;
    
    /** @var Nette\Security\User */
    private $user;


    public function __construct(FormFactory $factory, 
                                Model\UserManager $userManager, 
                                Nette\Security\User $user)
    {
            $this->factory = $factory;
            $this->userManager = $userManager;
            $this->user=$user;
    }

    /**
     * @return Form
     */
    public function create(callable $onSuccess)
    {
        $form = $this->factory->create();
        $form->addText('username', 'Uživatelské jméno:')
                ->setRequired('Uživatelské jméno');

        $form->addEmail('email', 'Email:')
                ->setRequired('Zadejte prosím Váš e-mail.');

        $form->addPassword('password', 'Heslo:')
                ->setOption('description', sprintf('aspoň %d znaků', self::PASSWORD_MIN_LENGTH))
                ->setRequired('Prosím zadejte heslo.')
                ->addRule($form::MIN_LENGTH, 'Délka hesla musí být aspoň %d znaků', self::PASSWORD_MIN_LENGTH);

        $form->addPassword('password2', 'Zopakujte pro ověření:')
                ->setOption('description', sprintf('aspoň %d znaků', self::PASSWORD_MIN_LENGTH))
                ->setRequired('Prosím zadejte heslo pro ověření.')
                ->addRule($form::MIN_LENGTH, 'Délka hesla musí být aspoň %d znaků', self::PASSWORD_MIN_LENGTH);

        $form->addSubmit('send', ' Vytvořit účet ');
        
        /**************** osluha stisku tlačítka anonymní funkcí ***********************/
        $form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
            if (!($values->password==$values->password2)) {
                $form['password']->addError('Hesla nesouhlasí. Opakujte prosím zadání.');
                return;
            }
            
            try {
                    /* přidání uživatele bez login*/
                    $this->userManager->add($values->username, $values->email, $values->password);
                    /* login pro přidaného uživatele */ 
                    //$this->user->setExpiration('30 minutes');
                    //$this->user->login($values->username, $values->password);
                } catch (Model\DuplicateNameException $e) {
                        $form['username']->addError(' uživatelské jméno již existuje. Použijte prosím jiné. ');
                        return;
                }
            $onSuccess();
            
        };
        /* ************** konec obluhy stisku talčítka *******************/
        return $form;
    }
}
