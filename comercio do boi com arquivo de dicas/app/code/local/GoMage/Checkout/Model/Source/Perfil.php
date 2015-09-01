<?php
class Gomage_Checkout_Model_Source_Perfil extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	public function getAllOptions()
	{
		if ($this->_options === null) {
			$this->_options = array();
			$this->_options[] = array(
                    'value' => 1,
                    'label' => 'Comprar'
			);
                        $this->_options[] = array(
                    'value' => 2,
                    'label' => 'Comprar e vender'
			);
		}

		return $this->_options;
	}
}

