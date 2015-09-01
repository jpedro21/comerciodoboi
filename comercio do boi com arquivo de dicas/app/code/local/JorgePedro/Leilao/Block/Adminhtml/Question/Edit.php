<?php

class Widecommerce_Perguntas_Block_Adminhtml_Question_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'perguntas';
        $this->_controller = 'adminhtml_question';
        
        $this->_headerText = Mage::helper('perguntas')->__('Criar Pergunta');

        $this->_updateButton('save', 'label', Mage::helper('perguntas')->__('Salvar Pergunta'));
        $this->_updateButton('delete', 'label', Mage::helper('perguntas')->__('Deletar Pergunta'));
    }

//    public function getHeaderText() {
//        if (Mage::registry('manufacturer_data') && Mage::registry('manufacturer_data')->getId()) {
//            return Mage::helper('manufacturer')->__("Edit Manufacturer"); //'%s'", $this->htmlEscape(Mage::registry('manufacturer_data')->getMenufecturerName()));
//        } else {
//            return Mage::helper('manufacturer')->__('Add Manufacturer');
//        }
//    }

}
