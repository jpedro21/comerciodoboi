<?php

class JorgePedro_Leilao_Model_Observer {
    
    public function createUser($observer) {
        try {
        $customer = $observer->getEvent()->getCustomer();
//        print_r($customer->getData());
//        die('aqui;');
        //apenas compra
//        if($customer->getContrato() == '1') {
            if($customer->getPerfil() == 1) {
                $model = Mage::getModel("leilao/leiloeiro");
                $model->setData('id_customer', $customer->getData('entity_id'));
                $model->save();
            }
        }  catch (Exception $ex) {
            print_r($ex->getMessage());
            die;
        }
//        } else {
//            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('O contrato deve ser aceito caso queira se cadastrar no site.'));
//            $this->_redirect('*/*/customer/account/create');
//        }
            
    }
}
