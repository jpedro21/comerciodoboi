<?php
/**
 * @category   JorgePedro
 * @package    JorgePedro_Leilao
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$this->getTable('jorgepedro_leilao_lance')};
CREATE TABLE `{$this->getTable('jorgepedro_leilao_lance')}` (
  `id` INTEGER unsigned NOT NULL auto_increment,
  `id_customer` INTEGER unsigned NOT NULL,  
  PRIMARY KEY  (`id`),
  KEY `FK_JORGEPEDRO_LEILAO_LANCE_ID_CUSTOMER` (`id_customer`),
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_LANCE_ID_CUSTOMER` FOREIGN KEY (`id_customer`) REFERENCES `{$this->getTable('customer_entity')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE    
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS {$this->getTable('jorgepedro_leilao_leiloeiro')};
CREATE TABLE `{$this->getTable('jorgepedro_leilao_leiloeiro')}` (
  `entity_id` INTEGER unsigned NOT NULL auto_increment,
  `id_customer` INTEGER unsigned NOT NULL,
  `numero_eventos` decimal(12,4) NOT NULL default 0,
  `reputation_points` decimal(12,4) NOT NULL default 0,
  PRIMARY KEY  (`entity_id`),
  KEY `FK_JORGEPEDRO_LEILAO_LEILOEIRO_ID_CUSTOMER` (`id_customer`),
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_LEILOEIRO_ID_CUSTOMER` FOREIGN KEY (`id_customer`) REFERENCES `{$this->getTable('customer_entity')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS {$this->getTable('jorgepedro_leilao_evento')};
CREATE TABLE `{$this->getTable('jorgepedro_leilao_evento')}` (
  `entity_id` INTEGER unsigned NOT NULL auto_increment,
  `id_product` INTEGER unsigned NOT NULL,
  `id_leiloeiro` INTEGER unsigned NOT NULL,
  `nome` varchar(250) NOT NULL default '',
  `date_start` DATETIME default '0000-00-00 00:00:00',
  `date_end` DATETIME default '0000-00-00 00:00:00',
  `minimum_value` decimal(12,4) NOT NULL default 0,
  PRIMARY KEY  (`entity_id`),
  KEY `FK_JORGEPEDRO_LEILAO_EVENTO_ID_PRODUCT` (`id_product`),
  KEY `FK_JORGEPEDRO_LEILAO_EVENTO_ID_LEILOEIRO` (`id_leiloeiro`),
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_EVENTO_ID_PRODUCT` FOREIGN KEY (`id_product`) REFERENCES `{$this->getTable('catalog_product_entity')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,    
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_EVENTO_ID_LEILOEIRO` FOREIGN KEY (`id_leiloeiro`) REFERENCES `{$this->getTable('jorgepedro_leilao_leiloeiro')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS {$this->getTable('jorgepedro_leilao_lance_evento')};
CREATE TABLE `{$this->getTable('jorgepedro_leilao_lance_evento')}` (
  `id_lance_evento` INTEGER unsigned NOT NULL auto_increment,
  `id_evento` INTEGER unsigned NOT NULL,
  `id_lance` INTEGER unsigned NOT NULL,
  `value` decimal(12,4) NOT NULL default 0,
  `date` DATETIME default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_lance_evento`),
  KEY `FK_JORGEPEDRO_LEILAO_LANCE_EVENTO_ID_EVENTO` (`id_evento`),
  KEY `FK_JORGEPEDRO_LEILAO_LANCE_EVENTO_ID_LANCE` (`id_lance`),
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_LANCE_EVENTO_ID_EVENTO` FOREIGN KEY (`id_evento`) REFERENCES `{$this->getTable('jorgepedro_leilao_evento')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_LANCE_EVENTO_ID_LANCE` FOREIGN KEY (`id_lance`) REFERENCES `{$this->getTable('jorgepedro_leilao_lance')}` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS {$this->getTable('jorgepedro_leilao_leiloeiro_product')};
CREATE TABLE `{$this->getTable('jorgepedro_leilao_leiloeiro_product')}` (
  `id_leiloeiro_product` INTEGER unsigned NOT NULL auto_increment,
  `id_leiloeiro` INTEGER unsigned NOT NULL,
  `id_product` INTEGER unsigned NOT NULL,
  PRIMARY KEY  (`id_leiloeiro_product`),
  KEY `FK_JORGEPEDRO_LEILAO_LEILOEIRO_PRODUCT_ID_LEILOEIRO` (`id_leiloeiro`),
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_LEILOEIRO_PRODUCT_ID_LEILOEIRO` FOREIGN KEY (`id_leiloeiro`) REFERENCES `{$this->getTable('jorgepedro_leilao_leiloeiro')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  KEY `FK_JORGEPEDRO_LEILAO_LEILOEIRO_PRODUCT_ID_PRODUCT` (`id_product`),
  CONSTRAINT `FK_JORGEPEDRO_LEILAO_LEILOEIRO_PRODUCT_ID_PRODUCT` FOREIGN KEY (`id_product`) REFERENCES `{$this->getTable('catalog_product_entity')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

");

$installer->endSetup();
