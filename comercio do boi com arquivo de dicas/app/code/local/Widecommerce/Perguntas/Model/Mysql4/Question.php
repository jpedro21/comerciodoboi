<?php

class Widecommerce_Perguntas_Model_Mysql4_Question extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('perguntas/question', 'id');
    }
    
}
