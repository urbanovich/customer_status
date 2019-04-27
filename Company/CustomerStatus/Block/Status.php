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

    protected $formKey;

    public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      \Company\CustomerStatus\Ui\Component\Options\Statuses $status,
      \Company\CustomerStatus\Model\ResourceModel\Status $statusResource,
      \Magento\Customer\Model\Session $customerSession,
      \Magento\Framework\Data\Form\FormKey $formKey,
      array $data = []
    ) {
        $this->status = $status;
        $this->statusResource = $statusResource;
        $this->customerSession = $customerSession;
        $this->formKey = $formKey;
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

    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    public function getStatusName()
    {
        $statuses = $this->status->toOptionArray();
        $data = $this->statusResource->getStatus($this->getCustomerId());

        $name = '';
        foreach ($statuses as $s) {
            if ($s['value'] == $data['status']) {
                $name = $s['label'];
                break;
            }
        }

        return $name;
    }
}