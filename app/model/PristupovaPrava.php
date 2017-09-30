<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

/**
 * Description of PristupovaPrava
 *
 * @author Roman Hronza
 */
class PristupovaPrava {
    private $uzivatele=[];
    private $role=[];
    private $zdroje=[];
    private $cinnosti=[];
    private $db=[];
    
    public function __construct(\Nette\Database\Context $db) {
        $this->db=$db;
    }
    
    public function getUzivataleToSelect() {
        $users= $this->db->table('users');
        foreach ($users as $user)
            {$this->uzivatele[$user->id]=$user->username;}
        return $this->uzivatele;
    }
    public function getRoleToSelect() {
        $roles= $this->db->table('role');
        foreach ($roles as $role)
            {$this->role[$role->id]=$role->nazev;}
        return $this->role;
    }
    public function getZdrojeToSelect() {
        $zdrojes= $this->db->table('zdroje');
        foreach ($zdrojes as $zdroj)
            {$this->zdroje[$zdroj->id]=$zdroj->nazev;}
        return $this->zdroje;
    }
    public function getCinnostiToSelect() {
        $cinnosti= $this->db->table('cinnosti');
        foreach ($cinnosti as $cinnost)
            {$this->cinnosti[$cinnost->id]=$cinnost->nazev;}
        return $this->cinnosti;
    }
}
    
    
    

