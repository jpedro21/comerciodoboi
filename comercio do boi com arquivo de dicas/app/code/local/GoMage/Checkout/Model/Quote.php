<?php

/**
 * GoMage LightCheckout Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2010-2012 GoMage (http://www.gomage.com)
 * @author       GoMage
 * @license      http://www.gomage.com/license-agreement/  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 3.2
 * @since        Class available since Release 1.0
 */
class GoMage_Checkout_Model_Quote extends Mage_Sales_Model_Quote {

    public function setCustomer(Mage_Customer_Model_Customer $customer) {
        $this->_customer = $customer;
        $this->setCustomerId($customer->getId());

        $quote_taxvat = false;
        $quote_dob = false;
        
        /* ADD RG E TIPO  */
        $quote_rgie = false;       
        $quote_tipo= false;       
        /* ADD RG E TIPO  */

        if ($this->getCustomerTaxvat()) {
            $quote_taxvat = $this->getCustomerTaxvat();
        }
        if ($this->getCustomerDob()) {
            $quote_dob = $this->getCustomerDob();
        }  
        if ($this->getCustomerTipo()) {
            $quote_tipo= $this->getCustomerTipo();
        }
        if ($this->getCustomerRgie()) {
            $quote_rgie = $this->getCustomerRgie();
        }    

        Mage::helper('core')->copyFieldset('customer_account', 'to_quote', $customer, $this);

        if ($quote_taxvat) {
            $this->setCustomerTaxvat($quote_taxvat);
        }
        if ($quote_dob) {
            $this->setCustomerDob($quote_dob);
        }
        if ($quote_tipo) {
            $this->setCustomerTipo($quote_tipo);
        }     
        if ($quote_rgie) {
            $this->setCustomerRgie($quote_rgie);
        }   

        return $this;
    }

}