<?php

error_reporting(E_ALL | E_STRICT);

define('MAGENTO_ROOT', getcwd());
$mageFilename = MAGENTO_ROOT . '/app/Mage.php';
require_once($mageFilename); //Path to Magento
#var_dump($mageFilename);exit;
umask(0);
Mage::app();
//Mage::init();

Mage::setIsDeveloperMode(true);
Varien_Profiler::enable();
ini_set('display_errors', 1);

$setup = Mage::getModel('customer/entity_setup', 'core_setup');

//var_dump($setup->addAttribute());exit;

//$setup->addAttribute('customer', 'perfil', array(
//	'type' => 'int',
//	'input' => 'select',
//	'label' => 'Perfil de Cliente',
//	'global' => 1,
//	'visible' => 1,
//	'required' => 0,
//	'user_defined' => 1,
//	'default' => '1',
//	'visible_on_front' => 1,
//        'source' =>	 'gomage_checkout/source_perfil',
//));
//
//$setup->addAttribute('customer', 'nickname', array(
//	'type' => 'varchar',
//	'input' => 'text',
//	'label' => 'Apelido',
//	'global' => 1,
//	'visible' => 1,
//	'required' => 0,
//	'user_defined' => 1,
//	'visible_on_front' => 1,
//));

$setup->removeAttribute('customer', 'perfil');

//
//$setup->addAttribute('customer', 'profissao', array(
//	'type' => 'varchar',
//	'input' => 'text',
//	'label' => 'Profissão',
//	'global' => 1,
//	'visible' => 1,
//	'required' => 0,
//	'user_defined' => 1,
//	'visible_on_front' => 1,
//));

if (version_compare(Mage::getVersion(), '1.6.0', '<='))
{
	$customer = Mage::getModel('customer/customer');
	$attrSetId = $customer->getResource()->getEntityType()->getDefaultAttributeSetId();
	$setup->addAttributeToSet('customer', $attrSetId, 'General', 'tipo');
	$setup->addAttributeToSet('customer', $attrSetId, 'General', 'rgie');	
	$setup->addAttributeToSet('customer', $attrSetId, 'General', 'profissao');	
}

//if (version_compare(Mage::getVersion(), '1.4.2', '>='))
//{
//	Mage::getSingleton('eav/config')
//	->getAttribute('customer', 'perfil')
//	->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit','checkout_register'))
//	->save();
//	
//	Mage::getSingleton('eav/config')
//	->getAttribute('customer', 'nickname')
//	->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit','checkout_register'))
//	->save();	
//	
//	Mage::getSingleton('eav/config')
//	->getAttribute('customer', 'contrato')
//	->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit','checkout_register'))
//	->save();	
//
//}

//$installer = Mage::getModel('sales/entity_setup', 'core_setup');
//$installer->getConnection()->addColumn($installer->getTable('sales/quote'), 'customer_tipo', 'TINYINT(1)  DEFAULT NULL');
////$installer->getConnection()->addColumn($installer->getTable('sales/quote'), 'customer_rgie', 'VARCHAR(255)  DEFAULT NULL');
//$installer->getConnection()->addColumn($installer->getTable('sales/quote'), 'customer_profissao', 'VARCHAR(255)  DEFAULT NULL');

//$installer->endSetup();

echo 'Campos importados para o banco dados finalizado!';
?>
