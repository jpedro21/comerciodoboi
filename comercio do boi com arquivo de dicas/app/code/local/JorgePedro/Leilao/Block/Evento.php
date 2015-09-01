<?php

class JorgePedro_Leilao_Block_Evento extends Mage_Catalog_Block_Product_List {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getProductsId() {
        $leiloeiro = Mage::getModel('leilao/leiloeiro')->getCurrentLeiloeiroSession();

        return Mage::getModel('leilao/product')
                ->getLeiloeiroProducts($leiloeiro->getData('entity_id'));        
    }
    
    public function loadProduct($id) {
        return Mage::getModel('leilao/product')->loadProduct($id);
    }
    
    public function getLeiloeiroEventos() {
        $leiloeiro = Mage::getModel('leilao/leiloeiro')->getCurrentLeiloeiroSession();
        return Mage::getModel('leilao/evento')
                ->getLeiloeiroEventos($leiloeiro->getData('entity_id'));
    }
    
    public function getUrlFormSaveEvento() {
        return Mage::getBaseUrl() . 'leilao/evento/saveEvento';
    }
}
