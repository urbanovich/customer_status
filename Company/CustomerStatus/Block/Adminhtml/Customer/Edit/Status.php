<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 27.4.19
 * Time: 15.59
 */

namespace Company\CustomerStatus\Block\Adminhtml\Customer\Edit;


use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;

class Status extends Generic implements TabInterface
{

    protected $_systemStore;

    protected $_coreRegistry;

    protected $statuses;

    protected $status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param array                                   $data
     */
    public function __construct(
      \Magento\Backend\Block\Template\Context $context,
      \Magento\Framework\Registry $registry,
      \Magento\Framework\Data\FormFactory $formFactory,
      \Magento\Store\Model\System\Store $systemStore,
      \Company\CustomerStatus\Ui\Component\Options\Statuses $statuses,
      \Company\CustomerStatus\Model\ResourceModel\Status $status,
      array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_systemStore = $systemStore;
        $this->statuses = $statuses;
        $this->status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    public function getTabLabel()
    {
        return __('Customer Status');
    }

    public function getTabTitle()
    {
        return __('Customer Status');
    }

    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    public function isHidden()
    {
        if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }

    public function getTabClass()
    {
        return '';
    }

    public function getTabUrl()
    {
        return '';
    }

    public function isAjaxLoaded()
    {
        return false;
    }

    public function initForm()
    {
        if (!$this->canShowTab()) {
            return $this;
        }
        /**@var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('customer_status_form');

        $fieldset = $form->addFieldset('base_fieldset',
            ['legend' => __('Customer Status Information')]);

        $fieldset->addField(
            'status',
            'select',
            [
                'name'           => 'status',
                'data-form-part' => $this->getData('target_form'),
                'label'          => __('Customer Status'),
                'title'          => __('Customer Status'),
                'values'         => $this->statuses->toOptionArray(),
            ]
        );

        $form->setValues($this->status->getStatus($this->getCustomerId()));
        $this->setForm($form);
        return $this;
    }

    protected function _toHtml()
    {
        if ($this->canShowTab()) {
            $this->initForm();
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}