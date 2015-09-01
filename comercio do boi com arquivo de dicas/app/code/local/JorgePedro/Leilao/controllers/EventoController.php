<?php

class JorgePedro_Leilao_EventoController extends Mage_Core_Controller_Front_Action {
    
    public function criarEventoAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function listEventoAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function saveEventoAction() {
        $request = $this->getRequest()->getPost();
        $evento = Mage::getModel('leilao/evento');
        $evento->setData(''$re)
    }

}
