<?php
require_once 'Mage/Customer/Block/Widget/Taxvat.php';
class Gomage_Checkout_Block_Widget_Taxvat extends Mage_Customer_Block_Widget_Taxvat
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('gomage/cliente/customer/widget/taxvat.phtml');
    }
}

