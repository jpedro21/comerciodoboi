<?php

class JorgePedro_Leilao_Block_Leiloeiro extends Mage_Core_Block_Template {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getUrlFormMudarPerfil() {
        return Mage::getBaseUrl() . 'leilao/leiloeiro/saveMudarPerfil/';
    }
    
    public function getUrlFormSaveAnimal() {
        return Mage::getBaseUrl() . 'leilao/leiloeiro/saveAnimal/';
    }
}
