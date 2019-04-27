<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 27.4.19
 * Time: 16.30
 */

namespace Company\CustomerStatus\Plugin\Customer\Controller\Adminhtml\Index;


class Save
{
    protected $statusFactory;
    protected $customerSession;

    public function __construct(
      \Company\CustomerStatus\Model\StatusFactory $statusFactory,
      \Magento\Customer\Model\Session $customerSession
    ) {
        $this->statusFactory = $statusFactory;
        $this->customerSession = $customerSession;
    }


    public function afterExecute(
      \Magento\Customer\Controller\Adminhtml\Index\Save $subject,
      $result
    ) {
        $data = $subject->getRequest()->getParams();
        $customerStatus = $subject->getRequest()->getParam('status');
        if (!empty($customerStatus)) {
            $status = $this->statusFactory->create();
            $status->setData([
              'customer_id' => $data['customer']['entity_id'],
              'status' => $customerStatus
            ]);
            $status->save();
        }

        return $result;
    }
}