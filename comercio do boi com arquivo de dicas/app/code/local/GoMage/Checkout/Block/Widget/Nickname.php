<?php
class Gomage_Checkout_Block_Widget_Nickname extends Mage_Customer_Block_Widget_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('gomage/customer/widget/nickname.phtml');
    }

}

