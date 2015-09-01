<?php

class JorgePedro_Leilao_Model_Customer {

    public function countNickname($nickname) {
        $collection = Mage::getModel('customer/customer')
                ->getCollection()
                ->addAttributeToSelect('nickname')
                ->addAttributeToFilter('nickname', $nickname)->load();
        
        
        return $collection->count();
    }

}
