<?php

class JorgePedro_Leilao_Model_Product extends Mage_Core_Model_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('leilao/product');
    }
    
    public function getLeiloeiroProducts($id_leiloeiro) {
        $product = $this->getCollection();
        $product->getSelect()->where('main_table.id_leiloeiro = ' . $id_leiloeiro);
        
        return $product;
    }
    
     public function loadProduct($id_product) {
        return Mage::getModel('catalog/product')->load($id_product);
    }
}