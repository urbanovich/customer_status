<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 25.4.19
 * Time: 20.19
 */

namespace Company\CustomerStatus\Model;


use Magento\Framework\Model\AbstractModel;

class Status extends AbstractModel
{

    /**
     * Page cache tag.
     */
    const CACHE_TAG = 'company_customer_status';

    /**
     * @var string
     */
    protected $_cacheTag = 'company_customer_status';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'company_customer_status';

    protected function _construct()
    {
        $this->_init(\Company\CustomerStatus\Model\ResourceModel\Status::class);
    }

}