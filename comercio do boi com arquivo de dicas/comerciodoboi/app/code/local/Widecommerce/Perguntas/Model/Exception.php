<?php

class Widecommerce_Perguntas_Model_Exception extends Mage_Core_Model_Abstract {
    
    public function _construct() {
        parent::_construct();
        $this->_init('perguntas/exception');
    }
    
    public function stopFlowQuestions($request, $attribute_code, $label) {
        if($request['attribute_code'] == $attribute_code) {
            $options = Mage::getModel('perguntas/question')->getOptionsAttribute($attribute_code);
            $attribute_option = $request['attribute_option'][0];
            foreach($options as $option) {
                if($option['value'] == $attribute_option && $option['label'] == $label) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    
}

