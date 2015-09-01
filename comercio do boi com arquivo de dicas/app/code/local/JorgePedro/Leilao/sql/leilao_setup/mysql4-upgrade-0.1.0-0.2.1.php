<?php
/**
 * @category   JorgePedro
 * @package    JorgePedro_Leilao
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('jorgepedro_leilao_leiloeiro_product')};
CREATE TABLE `{$this->getTable('jorgepedro_leiloeiro_product')}` (
  `id_leiloeiro_product` INTEGER unsigned NOT NULL auto_increment,
  `id_leiloeiro` INTEGER unsigned NOT NULL,
  `id_product` INTEGER unsigned NOT NULL,
  PRIMARY KEY  (`id_leiloeiro_product`),
  KEY `FK_JORGEPEDRO_LEILAO_LEILOEIRO_PRODUCT_ID_LEILOEIRO` (`id_leiloeiro`),
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_LEILOEIRO_PRODUCT_ID_LEILOEIRO` FOREIGN KEY (`id_leiloeiro`) REFERENCES `{$this->getTable('jorgepedro_leilao_leiloeiro')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
  KEY `FK_JORGEPEDRO_LEILAO_LEILOEIRO_PRODUCT_ID_PRODUCT` (`id_product`),
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_LEILOEIRO_PRODUCT_ID_PRODUCT` FOREIGN KEY (`id_product`) REFERENCES `{$this->getTable('catalog_product_entity')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

");

$installer->endSetup();
