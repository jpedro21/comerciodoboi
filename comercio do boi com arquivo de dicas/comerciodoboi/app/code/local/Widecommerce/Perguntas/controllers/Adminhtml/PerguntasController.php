<?php

class Widecommerce_Perguntas_Adminhtml_PerguntasController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('perguntas')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Perguntas'), Mage::helper('adminhtml')->__('Perguntas'));

        return $this;
    }

    public function indexAction() {
        $this->_initAction();
        //Página do Grid de perguntas cadastradas
        $this->_addContent($this->getLayout()->createBlock('perguntas/adminhtml_question'));
        $this->renderLayout();
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('perguntas/question')->load($id);
        
        //Register usado para exibir dados nos campos do form, caso existam
        Mage::register('perguntas_data', $model);
                
        $this->loadLayout();
        $this->_setActiveMenu('perguntas');

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Peruntas'), Mage::helper('adminhtml')->__('Perguntas'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Adicionar Pergunta'), Mage::helper('adminhtml')->__('Adicionar Pergunta'));
        
        $this->_setActiveMenu();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock('perguntas/adminhtml_question_edit'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        $data = $this->getRequest()->getPost();
        $helper = Mage::helper('perguntas');
        
        if (!isset($data['id_attribute']) || $data['id_attribute'] == '') {
            $this->_forward('edit');
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Selecione um atributo'));
        } else {
            if ($data) {
               
                try {//INICIO parte responsavel por salvar imagem
                    $helper->uploadImage($_FILES['url_img_1']['name'], 'url_img_1');
                    $helper->uploadImage($_FILES['url_img_2']['name'], 'url_img_2');
                    $helper->uploadImage($_FILES['url_img_3']['name'], 'url_img_3');
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Erro ao subir a(s) imagens ' . $e->getMessage()));
                    Mage::getSingleton('adminhtml/session')->setFormData($data);
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }//FIM parte responsavel por salvar imagem

                try {//INICIO parte responsavel por salvar dados em banco
                    if(isset($_FILES['url_img_1']['name']) && $_FILES['url_img_1']['name'] != '') {
                        $data['url_img_1'] = str_replace(" ", "_", $_FILES['url_img_1']['name']);
                    }
                    if(isset($_FILES['url_img_2']['name']) && $_FILES['url_img_2']['name'] != '') {
                        $data['url_img_2'] = str_replace(" ", "_", $_FILES['url_img_2']['name']);
                    }
                    if(isset($_FILES['url_img_3']['name']) && $_FILES['url_img_3']['name'] != '') {
                        $data['url_img_3'] = str_replace(" ", "_", $_FILES['url_img_3']['name']);
                    }
                    
                    $model_question  = Mage::getModel('perguntas/question');
                    $model_question->setData($data)->setId($this->getRequest()->getParam('id'));
                    $model_question->save();
                    
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('perguntas')->__('Pergunta salvada com sucesso.'));
                    Mage::getSingleton('adminhtml/session')->setFormData(false);

                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/*/edit', array('id' => $model_question->getId()));
                        return;
                    }
                    $this->_redirect('*/*/');
                    return;
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    Mage::getSingleton('adminhtml/session')->setFormData($data);
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }//FIM parte responsavel por salvar dados em banco
            }
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('perguntas')->__('Não foi possível salvar os dados'));
            $this->_redirect('*/*/');
        }
    }
    
    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('perguntas/question');

                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Pergunta excluida com sucesso.'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

}
