<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 25.4.19
 * Time: 20.50
 */

namespace Company\CustomerStatus\Block;


use Magento\Framework\View\Element\Template;

class Status extends Template
{

    public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getCustomerStatus()
    {
        return json_encode([]);
    }

    public function getStatuses()
    {
        return json_encode([]);
    }
}