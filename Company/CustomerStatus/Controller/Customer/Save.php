<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 25.4.19
 * Time: 20.39
 */

namespace Company\CustomerStatus\Controller\Customer;

use Magento\Framework\App\Action\Action;

class Save extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultJsonFactory;

    protected $status;

    protected $formKeyValidator;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Company\CustomerStatus\Model\StatusFactory $status,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
    ) {
        $this->resultJsonFactory = $resultJsonFactory->create();
        $this->status = $status;
        $this->formKeyValidator = $formKeyValidator;
        parent::__construct($context);
    }


    /**
     * Load the page defined in view/frontend/layout
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $success = false;
        if ($this->formKeyValidator->validate($this->getRequest())) {
            $data = $this->getRequest()->getParams();
            if (!empty($data)) {
                $status = $this->status->create();
                $status->setData($data);
                $status->save();

                $success = true;
            }
        } else {
            $this->_redirect('status/customer/index');
        }

        return  $this->resultJsonFactory->setData(['success' => $success]);
    }
}