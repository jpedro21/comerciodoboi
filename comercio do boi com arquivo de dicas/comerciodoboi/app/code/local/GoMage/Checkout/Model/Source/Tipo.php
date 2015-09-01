<?php
class Gomage_Checkout_Model_Source_Tipo extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	public function getAllOptions()
	{
		if ($this->_options === null) {
			$this->_options = array();
			$this->_options[] = array(
                    'value' => 1,
                    'label' => 'Pessoa física'
			);
			$this->_options[] = array(
                    'value' => 2,
                    'label' => 'Pessoa jurídica'
			);
		}

		return $this->_options;
	}
}

