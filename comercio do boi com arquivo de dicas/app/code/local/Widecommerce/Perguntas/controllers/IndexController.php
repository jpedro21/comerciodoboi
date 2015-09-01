<?php

class Widecommerce_Perguntas_IndexController extends Mage_Core_Controller_Front_Action {
    
    /*
     * Action responsavel por iniciar as perguntas. 
     * Caso já existas perguntas feitas a todas as sessões são limpas
     */
    public function indexAction() {
        Mage::getSingleton('core/session')->unsPilhaPerguntas();
        Mage::getSingleton('core/session')->unsPrevQuestion();
        Mage::getSingleton('core/session')->unsNextQuestion();
        Mage::getSingleton('core/session')->unsCurrentQuestion();
       
        if(Mage::getModel('perguntas/question')->countQuestions() > 0) {
            $this->_setCurrentQuestionSession();        
            $this->_setOptionsQuestionSession();
        }
                
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function startAction() {
        $this->_setCurrentQuestionSession();        
        $this->_setOptionsQuestionSession();
        
        if(!Mage::getModel('perguntas/exception')->stopFlowQuestions($this->getRequest()->getPost(), 'sexo', 'Feminino')) {
            $this->loadLayout();
            $this->renderLayout();
        } else {
            $this->_redirect('perguntas/index/result');
        }
    }
    
    public function resultAction() {
        //salva em sessão a ultima pergunta realizada antes de mostrar resultado
        $this->_setCurrentQuestionSession();        
        $this->_setOptionsQuestionSession();
        
        $this->loadLayout();
        $this->renderLayout();
    }
    
    /*
     * Ao avançar uma questão a função abaixo grava em sessão as opções 
     * selecionadas da pergunta anterior 
     */
    public function _setOptionsQuestionSession() {
        $request = $this->getRequest()->getPost();
        $session = Mage::getSingleton('core/session');
        $perguntas = $session->getPilhaPerguntas();
        $prev_question = $session->getPrevQuestion();
        $current_question = $session->getCurrentQuestion();
        
        if(!empty($perguntas)) {
           if(!empty($request['next'])) {
               $id = $prev_question->getId();
               $perguntas[$id] = array($request['attribute_code'] => $request['attribute_option']);
           } elseif(!empty($request['result'])) {
               $id = $current_question->getId();
               $perguntas[$id] = array($request['attribute_code'] => $request['attribute_option']);
           } 
        }
        
        $session->setPilhaPerguntas($perguntas);
    }
    
    /*
     * Grava em sessão as perguntas que foram respondidas.
     * Grava em sessão a pergunta corrente, proxima e anterior
     */
    public function _setCurrentQuestionSession() {
        $model =  Mage::getModel('perguntas/question');
        $request = $this->getRequest()->getPost();
        $session = Mage::getSingleton('core/session');
        $perguntas = $session->getPilhaPerguntas();
        $current_question = $session->getCurrentQuestion();
        
        if(empty($perguntas)) {
            $current_question = $model->getFirstQuestion();
            $perguntas = array($current_question->getId() => '');
            
            $session->setPilhaPerguntas($perguntas);
            $session->setPrevQuestion($current_question);
            $session->setCurrentQuestion($current_question);
        } elseif(!empty($request['next']) && $model->getNextQuestion($current_question->getId())) {
            $next_question = $model->getNextQuestion($current_question->getId());
            
            $perguntas = $session->getPilhaPerguntas();
            $perguntas += array($next_question->getId() => '');
            
            $session->setPilhaPerguntas($perguntas);
            $session->setPrevQuestion($current_question);
            $session->setCurrentQuestion($next_question);
        } elseif(!empty($request['prev']) && $model->getPrevQuestion($current_question->getId())) {
            $prev_question = $model->getPrevQuestion($current_question->getId());
            
            $perguntas = $session->getPilhaPerguntas();
            $perguntas += array($prev_question->getId() => '');
            
            $session->setPilhaPerguntas($perguntas);
            $session->setPrevQuestion($current_question);
            $session->setCurrentQuestion($prev_question);
        }
    }

}
