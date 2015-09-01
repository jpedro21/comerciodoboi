<?php

class JorgePedro_Leilao_LeiloeiroController extends Mage_Core_Controller_Front_Action {

    public function mudarPerfilAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveMudarPerfilAction() {
        $request = $this->getRequest()->getPost();
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        $leiloeiro = Mage::getModel('leilao/leiloeiro')->getLeiloeiro($customer->getData('entity_id'));
        if (isset($request['contrato']) && $request['contrato'] == 1 && empty($leiloeiro->getData())) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $customer->setContrato(1);

            $leiloeiro = Mage::getModel('leilao/leiloeiro');
            $leiloeiro->setIdCustomer($customer->getData('entity_id'));

            try {
                $customer->save();
                $leiloeiro->save();
                Mage::getSingleton('core/session')->addSuccess(Mage::helper('leilao')->__('Perfil mudado com sucesso.'));
            } catch (Exception $ex) {
                Mage::getSingleton('core/session')->addError(Mage::helper('leilao')->__('Falha ao mudar perfil.'));
                Mage::log($ex);
            }
        } else {
            Mage::getSingleton('core/session')->addError(Mage::helper('leilao')->__('Os termos de contrado devem ser aceitos caso queira ser um leiloeiro.'));
        }

        $this->_redirect('customer/account/index/');
    }

    public function cadastrarAnimaisAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAnimalAction() {
        $request = $this->getRequest()->getPost();
        
        $leiloeiro = Mage::getModel('leilao/leiloeiro')->getCurrentLeiloeiroSession();
        $leiloeiro_product = Mage::getModel('leilao/product');
        
        $product = new Mage_Catalog_Model_Product();
        $product->setAttributeSetId(4); // #4 is for default
        $product->setTypeId('simple');

        $product->setName($request['name']);
        $product->setDescription($request['description']);
        $product->setShortDescription('Short description here');
        $product->setSku(time());
        $product->setWeight(1.0000);
        $product->setStatus(1);
        $product->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH); //4
        
        $product->setPrice($request['price']); // # Set some price
        $product->setTaxClassId(0); // # default tax class

        $product->setStockData(array(
            'is_in_stock' => 1,
            'qty' => 1
        ));

        //$product->setCategoryIds(array(27)); // # some cat id's,

        $product->setWebsiteIDs(array(1)); // # Website id, 1 is default
//Default Magento attribute

        $product->setCreatedAt(strtotime('now'));


//print_r($product);
        try {
            $product->save();
            $leiloeiro_product->setData('id_leiloeiro', $leiloeiro->getData('entity_id'));
            $leiloeiro_product->setData('id_product', $product->getId());
            $leiloeiro_product->save();
            echo "Product Created";
        } catch (Exception $ex) {
            //Handle the error
            echo "Product Creation Failed";
        }
    }

}
