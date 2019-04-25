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

    protected $status;

    protected $statusResource;

    protected $customerSession;

    public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      \Company\CustomerStatus\Ui\Component\Options\Statuses $status,
      \Company\CustomerStatus\Model\ResourceModel\Status $statusResource,
      \Magento\Customer\Model\Session $customerSession,
      array $data = []
    ) {
        $this->status = $status;
        $this->statusResource = $statusResource;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getCustomerId()
    {
        return $this->customerSession->getCustomer()->getId();
    }

    public function getCustomerStatus()
    {
        $status = $this->statusResource->getStatus($this->getCustomerId());
        return json_encode($status);
    }

    public function getStatuses()
    {
        return json_encode($this->status->toOptionArray());
    }
}