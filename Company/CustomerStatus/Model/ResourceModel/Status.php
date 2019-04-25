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

    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init('company_customer_status', 'entity_id');
    }

}