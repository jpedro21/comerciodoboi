<?php

class MarioSam_Enderecos_Model_Opcoes_Servidores {
	
    public function toOptionArray() {
        $options= array();
        
        $options[] = array('label' => 'RepublicaVirtual', 'value' => '1');
        $options[] = array('label' => 'KingHost', 'value' => '2');
        $options[] = array('label' => 'Locaweb', 'value' => '3');
            
        return $options;
    }
    
}
