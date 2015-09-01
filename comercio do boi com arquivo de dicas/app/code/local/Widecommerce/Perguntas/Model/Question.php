<?php

class Widecommerce_Perguntas_Model_Question extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('perguntas/question');
    }

    public function getFirstQuestion() {
        $perguntas = Mage::getModel('perguntas/question')->getCollection();
        $perguntas->getSelect()->where('main_table.status = 1')->order(array('order ASC'))->limit(1);
        
        $item = array_shift($perguntas->getItems());
        return $item;
    }
    
    public function getAllQuestions() {
        $perguntas = Mage::getModel('perguntas/question')->getCollection();
        $perguntas->getSelect()->where('main_table.status = 1')->order(array('order ASC'));
        
        $items = $perguntas->getItems();
        return $items;
    }
    
     public function countQuestions() {
        $perguntas = Mage::getModel('perguntas/question')->getCollection();
        $perguntas->getSelect()->where('main_table.status = 1')->order(array('order ASC'));
        
        return $perguntas->count();
    }
    
    public function getNextQuestion($id_current_question) {
        $questions = $this->getAllQuestions();
        $found = false;        
        foreach($questions as $value) {
            if($found) {
                return $value;
            }
            
            if($value->getId() == $id_current_question) {
                $found = true;
            } 
        }
        
        return false;
    }
    
    public function getPrevQuestion($id_current_question) {
        $questions = $this->getAllQuestions();
        
        $before = reset($questions);
        foreach($questions as $after) {
           if($before->getId() == $id_current_question) {
               return false;
           } elseif($after->getId() == $id_current_question) {
               return $before;
           }
           
           $before = $after;
        }
        
        return false;
    }
    
    public function getAttribute($id_attribute) {
        $attribute = Mage::getResourceModel('catalog/product_attribute_collection')->addVisibleFilter();
        $attribute->getSelect()->where('main_table.attribute_id = ' . $id_attribute);
        
        return array_shift($attribute->getItems());
    }
    
    public function getOptionsAttribute($attribute_code) {
        $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attribute_code);
        if ($attribute->usesSource()) {
            $options = $attribute->getSource()->getAllOptions(false);
        }
        
        return $options;
    }
    
    public function getProducts() {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->addAttributeToSelect('*');
        
        $questions = Mage::getSingleton('core/session')->getPilhaPerguntas();
        
       foreach($questions as $question) {
            foreach ($question as $key => $options) {
                $attribute_code = $key;
                $filter = array('attribute' => $attribute_code, 'in' => $options);
            }
            
            if(!empty($filter)) {
                $collection->addFieldToFilter(array($filter));
                $filter = array();
            }
        }
        
        echo $collection->getSelect()->__toString();
        
        return $collection;
    }

}
