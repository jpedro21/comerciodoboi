<?php

class JorgePedro_Leilao_CustomerController extends Mage_Core_Controller_Front_Action {
    
    public function nicknameAction() {
        $request = $this->getRequest()->getPost();
        echo Mage::getModel('leilao/customer')->countNickname($request['nickname']);
    }

}
