<?php

class JorgePedro_Leilao_Model_Mysql4_Leiloeiro_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('leilao/leiloeiro');
    }
}