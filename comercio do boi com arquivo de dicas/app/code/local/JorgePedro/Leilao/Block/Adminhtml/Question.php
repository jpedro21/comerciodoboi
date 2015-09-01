<?php

class Widecommerce_Perguntas_Block_Adminhtml_Question extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_blockGroup = 'perguntas';
        $this->_controller = 'adminhtml_question';
        $this->_headerText = Mage::helper('perguntas')->__('Gerenciar Perguntas');
        $this->_addButtonLabel = Mage::helper('perguntas')->__('Add Pergunta');
        parent::__construct();
    }

}
