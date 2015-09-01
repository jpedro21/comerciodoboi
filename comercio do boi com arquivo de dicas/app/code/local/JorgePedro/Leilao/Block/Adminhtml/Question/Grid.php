<?php

class Widecommerce_Perguntas_Block_Adminhtml_Question_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('perguntasGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('perguntas/question')->getCollection();
        $this->setCollection($collection);
        $collection->getSelect();
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header' => Mage::helper('perguntas')->__('ID'),
            'width' => '50px',
            'index' => 'id',
            'type'  => 'number'  
        ));

        $this->addColumn('title', array(
            'header' => Mage::helper('perguntas')->__('Título da Pergunta'),
            'width' => '100px',
            'index' => 'title',
        ));

        $this->addColumn('order', array(
            'header' => Mage::helper('perguntas')->__('Ordem'),
            'width' => '50px',
            'index' => 'order',
            'type'  => 'number'
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('perguntas')->__('Status'),
            'width' => '50px',
            'index' => 'status',
            'type'  => 'options',
            'options'   => array(
              1 => 'Habilitado',
              2 => 'Desabilitado',
          ),
        ));
        
        $this->addColumn('action', array(
            'header'    =>  Mage::helper('perguntas')->__('Action'),
            'width'     => '50px',
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => array(
                array(
                    'caption'   => Mage::helper('perguntas')->__('Edit'),
                    'url'       => array('base'=> '*/*/edit'),
                    'field'     => 'id'
                ),
            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'stores',
            'is_system' => true,
        ));

        return parent::_prepareColumns();
    }

}
