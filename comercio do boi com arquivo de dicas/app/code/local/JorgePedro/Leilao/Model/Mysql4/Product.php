<?php

class JorgePedro_Leilao_Model_Mysql4_Product extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('leilao/jorgepedro_leilao_leiloeiro_product', 'id_leiloeiro_product');
    }
    
}
