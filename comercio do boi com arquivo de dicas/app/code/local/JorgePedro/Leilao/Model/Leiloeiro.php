<?php

class JorgePedro_Leilao_Model_Leiloeiro extends Mage_Core_Model_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('leilao/leiloeiro');
    }
    
    public function getLeiloeiro($id_customer) {
        $leiloeiro = $this->getCollection();
        $leiloeiro->getSelect()->where('main_table.id_customer = ' . $id_customer);
        
        return $leiloeiro->getFirstItem();
    }
    
    public function getCurrentLeiloeiroSession() {
        $customer = Mage::getModel('customer/session')->getCustomer();
        return $this->getLeiloeiro($customer->getData('entity_id'));
    }
}