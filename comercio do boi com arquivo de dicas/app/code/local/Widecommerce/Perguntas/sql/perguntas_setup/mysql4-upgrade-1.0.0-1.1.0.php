<?php

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('widecommerce_perguntas_question'), 'url_img_1', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => '',
        'comment' => 'Imagem 1'
    )
);

$installer->getConnection()->addColumn($installer->getTable('widecommerce_perguntas_question'), 'url_img_2', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => '',
        'comment' => 'Imagem 2'
    )
);

$installer->getConnection()->addColumn($installer->getTable('widecommerce_perguntas_question'), 'url_img_3', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => '',
        'comment' => 'Imagem 3'
    )
);

$installer->endSetup();

