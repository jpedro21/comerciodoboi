<?php

class Widecommerce_Perguntas_Block_Adminhtml_Question_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form(
                array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                )       
        );
        
        $data = Mage::registry('perguntas_data');
        
        $fieldset = $form->addFieldset('question_form', array('legend' => Mage::helper('perguntas')->__('Informações da Pergunta')));

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('perguntas')->__('Titulo'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
                //'disabled' => 0
        ));

        $fieldset->addField('url_img_1', 'file', array(
            'label' => Mage::helper('perguntas')->__('Imagem 1'),
            'class' => '',
            'required' => false,
            'name' => 'url_img_1',
            'after_element_html' => $data->getData('url_img_1') != "" ? '<span class="hint"><img src="'.Mage::getBaseUrl('media')."Perguntas/".$data->getData('url_img_1').'" width="25" height="25" name="perguntas_image" style="vertical-align: middle;" /></span>':'',
        ));

        $fieldset->addField('url_img_2', 'file', array(
            'label' => Mage::helper('perguntas')->__('Imagem 2'),
            'class' => '',
            'required' => false,
            'name' => 'url_img_2',
            'after_element_html' => $data->getData('url_img_2') != "" ? '<span class="hint"><img src="'.Mage::getBaseUrl('media')."Perguntas/".$data->getData('url_img_2').'" width="25" height="25" name="perguntas_image" style="vertical-align: middle;" /></span>':'',
        ));

        $fieldset->addField('url_img_3', 'file', array(
            'label' => Mage::helper('perguntas')->__('Imagem 3'),
            'class' => '',
            'required' => false,
            'name' => 'url_img_3',
            'after_element_html' => $data->getData('url_img_3') != "" ? '<span class="hint"><img src="'.Mage::getBaseUrl('media')."Perguntas/".$data->getData('url_img_3').'" width="25" height="25" name="perguntas_image" style="vertical-align: middle;" /></span>':'',
        ));
        
        $fieldset->addField('order', 'text', array(
            'label' => Mage::helper('perguntas')->__('Ordem'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'order',
                //'disabled' => 0
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('perguntas')->__('Status'),
            'required' => true,
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('perguntas')->__('Habilitar'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('perguntas')->__('Desabilitar'),
                ),
            ),
        ));
        
        $attributes = Mage::helper('perguntas')->getAllAttributes();
        
        foreach ($attributes as $attribute) {
            // "21" é o ID correspondende ao agrupamento de atributos "Perguntas" 
            if ($attribute->getAttributeGroupId() == 21) {
                $fieldset->addField('id_attribute' . $attribute->getAttributeId(), 'radio', array(
                    'label' => $attribute->getFrontendLabel(),
                    'onclick' => 'this.value = this.checked ?'. $attribute->getAttributeId() . ': null;',
                    'name' => 'id_attribute',
                    'value' => $data->getData('id_attribute') == $attribute->getAttributeId() ? $attribute->getAttributeId() : '',
                ));
            }
        }
        
        if ($data) {
            $form->setValues($data->getData());
        }
        
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
