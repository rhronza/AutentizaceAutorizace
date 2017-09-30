<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

/**
 * Description of AutorizacePresenter
 *
 * @author Roman Hronza
 */
class AutorizacePresenter extends BasePresenter{
    
    private $database; // pro Explorer
    private $dbConnection; // pro DatabaseCore
    private $pp; // Přístupová práva


    const maximalniDelkaNazvuRole = 40;
    const maximalniDelkaNazvuZdroje = 40;
    const maximalniDelkaNazvuCinnosti = 40;
    
    public function __construct(\Nette\Database\Context $database, 
                                \Nette\Database\Connection $dbConnection,
                                \App\Model\PristupovaPrava $pp) {
       $this->database=$database;
       $this->dbConnection=$dbConnection;
       $this->pp=$pp;
    }
    
    public function renderRoleZdrojeCinnosti() {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
         }
        $this->template->role= $this->database->table('role');
        $this->template->zdroje= $this->database->table('zdroje');
        $this->template->cinnosti= $this->database->table('cinnosti');
        $this->template->uzivatele=$this->database->table('users');
        $this->template->pristupovaprava = $this->dbConnection
                ->query('select 
                        pp.id as pp_id, 
                        users.id as user_id, users.username, 
                        role.id as role_id, role.nazev as role_nazev, 
                        zdroje.id as zdroj_id, zdroje.nazev as zdroj_nazev, 
                        cinnosti.id as cinnost_id, cinnosti.nazev as cinnost_nazev
                        from pristupovaprava as pp
                        join users on users.id=pp.user_id
                        join role on role.id=pp.role_id
                        join zdroje on zdroje.id=pp.zdroj_id
                        join cinnosti on cinnosti.id=pp.cinnost_id
                        order by users.username, role.nazev, zdroje.nazev,cinnosti.nazev');
     }
     
    protected function createComponentRole() {
         $frm=new Form();
         $frm->addText('nazev', 'Role: ')->setRequired('Pole Role musí být vyplněno.')
             ->addRule(Form::MAX_LENGTH, 'Maximální délka názvu role je %d znaků', self::maximalniDelkaNazvuRole )
             ->setAttribute('style','padding: 5px; border-radius:3px; margin-bottom:10px; border-style:solid; width:350px');
         $frm->addSubmit('send', '   OK   ')->setAttribute('style','padding: 7px; border-radius:3px');
         $frm->onSuccess[]= function ($frm, $val){
            if(!$this->getUser()->isLoggedIn()){
                $this->redirect('Sign:in');
            }
            $roleId= $this->getParameter('idEdit');
            if ($roleId) {//update: 
                $tbl=$this->database->table('role')->where('id<>? AND nazev = ?', $roleId,$val->nazev);
                $pocet=$tbl->count('*');
                if(!$pocet==0){$frm->addError('Role s tímto názvem jej již zadána.');return;} 
                $this->database->table('role')->where('id = ?',$roleId)->update($val);
            } else { //insert:
               $tbl=$this->database->table('role')->where('nazev=?', $val->nazev);
               $pocet=$tbl->count('*');
               if ($pocet!=0){$frm->addError('Role s tímto názvem jej již zadána.');return;} 
               $this->database->table('role')->insert($val);
            }
            $this->redirect('Autorizace:rolezdrojecinnosti');
            };
         return $frm;
      }                         
    protected function createComponentZdroje() {
         $frm=new Form();
         $frm->addText('nazev', 'Zdroj: ')->setRequired('Pole Zdroj musí být vyplněno.')
             ->addRule(Form::MAX_LENGTH, 'Maximální délka názvu zdroje je %d znaků', self::maximalniDelkaNazvuZdroje )
             ->setAttribute('style','padding: 5px; border-radius:3px; margin-bottom:10px; border-style:solid; width:350px');
         $frm->addSubmit('send', '   OK   ')->setAttribute('style','padding: 7px; border-radius:3px');
         $frm->onSuccess[]= function ($frm, $val){
            if(!$this->getUser()->isLoggedIn()){
                $this->redirect('Sign:in');
            }
            $zdrojId= $this->getParameter('idEdit');
            if ($zdrojId) {//update: 
                $tbl=$this->database->table('zdroje')->where('id<>? AND nazev = ?', $zdrojId,$val->nazev);
                $pocet=$tbl->count('*');
                if(!$pocet==0){$frm->addError('Zdroj s tímto názvem jej již použit.');return;} 
                $this->database->table('zdroje')->where('id = ?',$zdrojId)->update($val);
            } else { //insert:
               $tbl=$this->database->table('zdroje')->where('nazev=?', $val->nazev);
               $pocet=$tbl->count('*');
               if ($pocet!=0){$frm->addError('Zdroj s tímto názvem jej již použit.');return;} 
               $this->database->table('zdroje')->insert($val);
            }
            $this->redirect('Autorizace:rolezdrojecinnosti');
         };
         $frm->onSuccess[]= function ($frm, $val){
            if(!$this->getUser()->isLoggedIn()){$this->redirect('Sign:in');}
            $roleId= $this->getParameter('idEdit');
            if ($roleId) {//update: 
                $tbl=$this->database->table('role')->where('id<>? AND nazev = ?', $roleId,$val->nazev);
                $pocet=$tbl->count('*');
                if(!$pocet==0){$frm->addError('Zdroj s tímto názvem jej již použit.');return;} 
                $this->database->table('role')->where('id = ?',$roleId)->update($val);
            } else { //insert:
               $tbl=$this->database->table('zdroje')->where('nazev=?', $val->nazev);
               $pocet=$tbl->count('*');
               if ($pocet!=0){$frm->addError('Zdroj s tímto názvem jej již použit.');return;} 
               $this->database->table('zdroje')->insert($val);
            }
            $this->redirect('Autorizace:roleZdrojeCinnosti');
         };
         return $frm;
      }                         
    protected function createComponentCinnosti() {
         $frm=new Form();
         $frm->addText('nazev', 'Činnost: ')->setRequired('Pole Činnost musí být vyplněno.')
            ->addRule(Form::MAX_LENGTH, 'Maximální délka názvu činnosti je %d znaků', self::maximalniDelkaNazvuCinnosti )
            ->setAttribute('style','padding: 5px; border-radius:3px; margin-bottom:10px; border-style:solid; width:350px');         $frm->addSubmit('send', '   OK   ')->setAttribute('style','padding: 7px; border-radius:3px');
         
         $frm->onSuccess[]= function ($frm, $val){
            if(!$this->getUser()->isLoggedIn()){$this->redirect('Sign:in');}
            $roleId= $this->getParameter('idEdit');
            if ($roleId) {//update: 
                $tbl=$this->database->table('cinnosti')->where('id<>? AND nazev = ?', $roleId,$val->nazev);
                $pocet=$tbl->count('*');
                if(!$pocet==0){$frm->addError('Činnost s tímto názvem jej již použita.');return;} 
                $this->database->table('cinnosti')->where('id = ?',$roleId)->update($val);
            } else { //insert:
               $tbl=$this->database->table('cinnosti')->where('nazev=?', $val->nazev);
               $pocet=$tbl->count('*');
               if ($pocet!=0){$frm->addError('Činnost s tímto názvem jej již použita.');return;} 
               $this->database->table('cinnosti')->insert($val);
            }
            $this->redirect('Autorizace:roleZdrojeCinnosti');
         };
         return $frm;
      }                         
    protected function createComponentPristupovaPrava() {
         $frm=new Form();
         // $frm->getOwnErrors()->
         $frm->addSelect('user_id','',$this->pp->getUzivataleToSelect())->setPrompt('Vyberte uživatele')->setRequired('Vyberte prosím uživatele.')->setAttribute('style', 'width:180px');
         $frm->addSelect('role_id','',$this->pp->getRoleToSelect())->setPrompt('Přiřaďte ROLI')->setRequired('Vyberte prosím roli.')->setAttribute('style', 'width:180px');
         $frm->addSelect('zdroj_id','',$this->pp->getZdrojeToSelect())->setPrompt('Přiřaďte ZDROJ')->setRequired('Vyberte prosím zdroj.')->setAttribute('style', 'width:180px');
         $frm->addSelect('cinnost_id','',$this->pp->getCinnostiToSelect())->setPrompt('Přiřaďte ČINNOST')->setRequired('Vyberte prosím činnost.')->setAttribute('style', 'width:180px');
         $frm->addSubmit('send', '     OK     ')->setAttribute('style','padding: 1px; border-radius:3px; margin-left:10px');
         
         $frm->onSuccess[]= function ($frm, $val){
            if(!$this->getUser()->isLoggedIn()){$this->redirect('Sign:in');}
             $roleId= $this->getParameter('idEdit');
            if ($roleId) {//update: 
                $tbl=$this->database->table('pristupovaprava')
                /*->where('id<>? AND nazev = ?', ,$val->nazev);*/
                ->where('id<> ? '
                        . 'AND user_id = ? '
                        . 'AND role_id = ? '
                        . 'AND zdroj_id =? '
                        . 'AND cinnost_id = ?', 
                        $roleId, $val->user_id, $val->role_id, $val->zdroj_id, $val->cinnost_id);
                $pocet=$tbl->count('*');
                if(!$pocet==0){$frm->addError(' Toto nastavení přístupových práv je již použito. ');return;} 
                $this->database->table('pristupovaprava')->where('id = ?',$roleId)->update($val);
            } else { //insert:
               $tbl=$this->database
                    ->table('pristupovaprava')
                    ->where('user_id = ? AND role_id = ? AND zdroj_id =? AND cinnost_id = ?', $val->user_id, $val->role_id, $val->zdroj_id, $val->cinnost_id);
               $pocet=$tbl->count('*');
               //var_dump($pocet); die;
               if ($pocet!=0){$frm->addError(' Toto nastavení přístupových práv je již použito. ');return;} 
               $this->database->table('pristupovaprava')->insert($val);
            }
            $this->redirect('Autorizace:roleZdrojeCinnosti');
         };
         return $frm;
      }                         
      
    public function actionZrusitRoli($id){
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        try {
            $this->database->table('role')->where('id',$id)->delete();
            $this->redirect('Autorizace:rolezdrojecinnosti');
        } catch (Nette\Database\ForeignKeyConstraintViolationException $exc) {
            $this->flashMessage('Záznam je použit. Nelze ho zrušit!');
            $this->redirect('Autorizace:rolezdrojecinnosti');
        }
    }
    public function actionZrusitZdroj($id) {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        try {
            $this->database->table('zdroje')->where('id',$id)->delete();
            $this->redirect('Autorizace:rolezdrojecinnosti');
        } catch (Nette\Database\ForeignKeyConstraintViolationException $exc) {
            $this->flashMessage('Záznam je použit. Nelze ho zrušit!');
            $this->redirect('Autorizace:rolezdrojecinnosti');
        }
    }
    public function actionZrusitCinnost($id) {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        try {
            $this->database->table('cinnosti')->where('id',$id)->delete();
            $this->redirect('Autorizace:rolezdrojecinnosti');
        } catch (Nette\Database\ForeignKeyConstraintViolationException $exc) {
            $this->flashMessage('Záznam je použit. Nelze ho zrušit!');
            $this->redirect('Autorizace:rolezdrojecinnosti');
        }
    }
    public function actionZrusitUzivatele($id) {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        try {
            $this->database->table('users')->where('id',$id)->delete();
            $this->redirect('Autorizace:rolezdrojecinnosti');
        } catch (Nette\Database\ForeignKeyConstraintViolationException $exc) {
            $this->flashMessage('Záznam je použit. Nelze ho zrušit!');
            $this->redirect('Autorizace:rolezdrojecinnosti');
        }
    }
    public function actionZrusitPristupovePravo($id) {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        try {
            $this->database->table('pristupovaprava')->where('id',$id)->delete();
            $this->redirect('Autorizace:rolezdrojecinnosti');
        } catch (Nette\Database\ForeignKeyConstraintViolationException $exc) {
            $this->flashMessage('Záznam je použit. Nelze ho zrušit!');
            $this->redirect('Autorizace:rolezdrojecinnosti');
        }
    }
    
    public function actionEditRole($idEdit) {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        $zzn= $this->database->table('role')->get($idEdit);
        if (!$zzn){
            $this->flashMessage('Záznam je použit. Nelze ho zrušit!');
            $this->redirect('Autorizace:roleZdrojeCinnosti');
        } else {
            $this['role']->setDefaults($zzn->toArray());
        }
    }
    
    public function actionEditZdroj($idEdit) {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        $zzn= $this->database->table('zdroje')->get($idEdit);
        if (!$zzn) {
            $this->flashMessage('Záznam nenalezen');
            $this->redirect('Autorizace:roleZdrojeCinnosti');
        }
        $this['zdroje']->setDefaults($zzn->toArray());
    }
    public function actionEditCinnost($idEdit) {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        $zzn= $this->database->table('cinnosti')->get($idEdit);
        if (!$zzn) {
            $this->flashMessage('Záznam nenalezen');
            $this->redirect('Autorizace:roleZdrojeCinnosti');
        }
        $this['cinnosti']->setDefaults($zzn->toArray());
    }

    public function actionEditPristupovaPrava($idEdit) {
        if(!$this->getUser()->isLoggedIn()){
             $this->redirect('Sign:in');
        }
        $zzn= $this->database->table('pristupovaprava')->get($idEdit);
        if (!$zzn) {
            $this->flashMessage('Záznam nenalezen');
            $this->redirect('Autorizace:roleZdrojeCinnosti');
        }
        $this['pristupovaPrava']->setDefaults($zzn->toArray());
    }
    

    
}

