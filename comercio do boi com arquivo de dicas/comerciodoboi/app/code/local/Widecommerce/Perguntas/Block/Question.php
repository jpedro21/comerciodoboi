<?php

class Widecommerce_Perguntas_Block_Question extends Mage_Core_Block_Template {
    
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * Retorna a questão corrente através da sessão, que é criada no IndexController
     */
    public function getQuestion() {
        if(Mage::getSingleton('core/session')->getCurrentQuestion() != null) {
            return Mage::getSingleton('core/session')->getCurrentQuestion();
        } else {
            return false;
        }
    }
    
//    public function getAllQuestions() {
//        return Mage::getModel('perguntas/question')->getAllQuestions();
//    }
    
    public function getNextQuestion($id_current_question) {
        return Mage::getModel('perguntas/question')->getNextQuestion($id_current_question);
    }
    
    public function getPrevQuestion($id_current_question) {
        return Mage::getModel('perguntas/question')->getPrevQuestion($id_current_question);
    }
    
    public function getAttribute($id_attribute) {
        return Mage::getModel('perguntas/question')->getAttribute($id_attribute);
    }
    
    public function getOptionsAttribute($attribute_code) {
        return Mage::getModel('perguntas/question')->getOptionsAttribute($attribute_code);
    }
    
}
