<?php

class JorgePedro_Leilao_Model_Evento extends Mage_Core_Model_Abstract {
    public function _construct() {
        parent::_construct();
        $this->_init('leilao/evento');
    }
    
    public function getLeiloeiroEventos($id_leiloeiro) {
        $evento = $this->getCollection();
        $evento->getSelect()->where('main_table.entity_id = ' . $id_leiloeiro);
        
        return $evento;
    }
    
}