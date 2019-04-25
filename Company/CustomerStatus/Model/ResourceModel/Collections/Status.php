<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 25.4.19
 * Time: 20.25
 */

namespace Company\CustomerStatus\Model\ResourceModel\Collections;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Status extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
          \Company\CustomerStatus\Model\Status::class,
          \Company\CustomerStatus\Model\ResourceModel\Status::class
        );
    }
}