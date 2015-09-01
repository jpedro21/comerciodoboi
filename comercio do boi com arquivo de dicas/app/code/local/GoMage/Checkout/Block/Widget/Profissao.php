<?php
class Gomage_Checkout_Block_Widget_Profissao extends Mage_Customer_Block_Widget_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('gomage/customer/widget/profissao.phtml');
    }

    public function getCustomer()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
    }
}

