<?php

class Widecommerce_Perguntas_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getAllAttributes() {
        $attributes = Mage::getResourceModel('catalog/product_attribute_collection')->addVisibleFilter();

        $attributes->getSelect()->join(array(
            'group' => 'eav_entity_attribute'), 'group.attribute_id = main_table.attribute_id', array('group.attribute_group_id')
        );

        return $attributes;
    }

    public function uploadImage($img_name, $field_name) {
        $path = Mage::getBaseDir('media') . DS . "Perguntas" . DS;

        if ($img_name != '' && $field_name != '') {
            try {
                $uploader_img = new Varien_File_Uploader($field_name);

                $uploader_img->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader_img->setAllowRenameFiles(false);
                $uploader_img->setFilesDispersion(false);

                $uploader_img->save($path, str_replace(" ", "_", $img_name));
            } catch (Exception $e) {
                throw new Exception;
            }
        }
    }

    public function validateExtensions($fileName) {
        if ($fileName != '') {
            $valid = array('jpg', 'jpeg', 'gif', 'png');
            $str = explode(".", $fileName);

            if (!in_array($str[1], $valid)) {
                return false;
            }
        }

        return true;
    }

    public function getLastPerguntaId() {
        $collection = Mage::getModel('perguntas/question')->getCollection();
        $item = $collection->getLastItem();
        return $item->getId();
    }
}
