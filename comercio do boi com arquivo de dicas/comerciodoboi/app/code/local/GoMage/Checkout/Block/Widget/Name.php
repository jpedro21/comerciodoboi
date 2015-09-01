<?php
require_once 'Mage/Customer/Block/Widget/Name.php';
class Gomage_Checkout_Block_Widget_Name extends Mage_Customer_Block_Widget_Name
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('gomage/cliente/customer/widget/name.phtml');
    }
}

