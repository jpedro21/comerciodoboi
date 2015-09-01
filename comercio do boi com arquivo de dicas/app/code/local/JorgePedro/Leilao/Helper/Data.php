<?php

class JorgePedro_Leilao_Helper_Data extends Mage_Core_Helper_Abstract {
    public function getUrlAddProduct() {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $leiloeiro = Mage::getModel('leilao/leiloeiro')->getLeiloeiro($customer->getData('entity_id'));
        if(!empty($leiloeiro->getData())) {
            return 'leilao/leiloeiro/cadastrarAnimais';
        } else {
            return 'leilao/leiloeiro/mudarPerfil';
        }
    }
    
    public function getUrlAddEvento() {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $leiloeiro = Mage::getModel('leilao/leiloeiro')->getLeiloeiro($customer->getData('entity_id'));
        if(!empty($leiloeiro->getData())) {
            return 'leilao/evento/listEvento';
        } else {
            return 'leilao/leiloeiro/mudarPerfil';
        }
    }
    
}

