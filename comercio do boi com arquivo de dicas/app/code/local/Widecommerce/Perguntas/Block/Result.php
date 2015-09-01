<?php

class Widecommerce_Perguntas_Block_Result extends Mage_Catalog_Block_Product_List {
    
    public function __construct() {
        parent::__construct();
        $this->_session = Mage::getSingleton('core/session');
        //$this->_questions = Mage::getModel('perguntas/question')->getAllQuestions();
    }
    
    public function getProducts() {
        return Mage::getModel('perguntas/question')->getProducts();
    }
    
}
