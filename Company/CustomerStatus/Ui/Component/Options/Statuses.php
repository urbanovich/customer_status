<?php
/**
 * Created by PhpStorm.
 * User: dzmitry
 * Date: 25.4.19
 * Time: 21.53
 */

namespace Company\CustomerStatus\Ui\Component\Options;


class Statuses implements \Magento\Framework\Data\OptionSourceInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => 'boss', 'label' => __('Boss')],
            ['value' => 'master', 'label' => __('Master')],
            ['value' => 'worker', 'label' => __('Worker')],
        ];
    }
}