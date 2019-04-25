<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 25.4.19
 * Time: 20.05
 */

namespace Company\CustomerStatus\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

    public function install(
      SchemaSetupInterface $setup,
      ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'company_customer_status'
         */
        $table = $installer->getConnection()->newTable(
          $installer->getTable('company_customer_status')
        )->addColumn(
          'entity_id',
          Table::TYPE_INTEGER,
          null,
          ['identity' => true, 'nullable' => false, 'primary' => true],
          'Entity id of data'
        )->addColumn(
          'customer_id',
          Table::TYPE_INTEGER,
          6,
          ['nullable' => false]
        )->addColumn(
          'status',
          Table::TYPE_TEXT,
          255,
          ['nullable' => false],
          'Status of customer'
        )->addIndex(
          $installer->getIdxName(
            'company_customer_status',
            ['entity_id', 'customer_id']
          ),
          ['entity_id', 'customer_id']
        )->setComment(
          'Table of customer status'
        );

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}