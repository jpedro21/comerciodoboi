<?php

class JorgePedro_Leilao_Model_Mysql4_Customer extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('leilao/jorgepedro_leilao_lance', 'id');
    }
    
}
