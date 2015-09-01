<?php

$installer = $this;
$installer->startSetup();

$installer->run("
    DROP TABLE IF EXISTS {$this->getTable('widecommerce_perguntas_question')};
    CREATE TABLE {$this->getTable('widecommerce_perguntas_question')} (
        `id` int(11) unsigned NOT NULL auto_increment,
        `title` varchar(255) NOT NULL default '',
        `status` smallint(6) NOT NULL default '0',
        `order` smallint(6) NOT NULL default '0',
        `id_attribute` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `FK_PERGUNTAS_ID_ATTRIBUTE` (`id_attribute`),
    CONSTRAINT `FK_PERGUNTAS_ID_ATTRIBUTE` FOREIGN KEY (`id_attribute`) REFERENCES `{$this->getTable('eav_attribute')}` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
    
$installer->endSetup();
