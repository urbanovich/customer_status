<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 25.4.19
 * Time: 20.22
 */

namespace Company\CustomerStatus\Model\ResourceModel;


use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Status extends AbstractDb
{

    protected const STATUS_TABLE = 'company_customer_status';

    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init('company_customer_status', 'entity_id');
    }

    public function getStatus($customerId)
    {
        $table = $this->getTable(self::STATUS_TABLE);

        $select = $this->getConnection()
            ->select()
            ->from($table)
            ->where('customer_id = ?', (int)$customerId);

        return $this->getConnection()->fetchRow($select);
    }

    public function deleteStatus($customerId)
    {
        $table = $this->getTable(self::STATUS_TABLE);
        return $this->getConnection()->delete(
                    $table,
                    [
                        'customer_id = ?' => $customerId
                    ]
                );
    }

    protected function _beforeSave(
      \Magento\Framework\Model\AbstractModel $object
    ) {
        $this->deleteStatus($object->getData('customer_id'));

        return parent::_beforeSave($object);
    }

}