<?php

namespace Kensium\DeliverySign\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Delivery sign fee config path
     */
    const CONFIG_DELIVERYSIGN_FEE = 'deliverysign/deliverysign/deliverysign_amount';
    const CONFIG_DELIVERYSIGN_IS_ENABLED = 'deliverysign/deliverysign/status';
    const CONFIG_MINIMUM_ORDER_AMOUNT = 'deliverysign/deliverysign/minimum_order_amount';
    const CONFIG_FEE_LABEL = 'deliverysign/deliverysign/name';
    /**
     * Get delivery sign fee
     *
     * @return mixed
     */
    public function getDeliverySignFee()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $fee = $this->scopeConfig->getValue(self::CONFIG_DELIVERYSIGN_FEE, $storeScope);
        return $fee;
    }

    /**
     * Get delivery sign fee
     *
     * @return mixed
     */
    public function getFeeLabel()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $feeLabel = $this->scopeConfig->getValue(self::CONFIG_FEE_LABEL, $storeScope);
        return $feeLabel;
    }
    /**
     * @return mixed
     */
    public function getMinimumOrderAmount()
    {

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $MinimumOrderAmount = $this->scopeConfig->getValue(self::CONFIG_MINIMUM_ORDER_AMOUNT, $storeScope);
        return $MinimumOrderAmount;
    }

    /**
     * @return mixed
     */
    public function isModuleEnabled()
    {

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $isEnabled = $this->scopeConfig->getValue(self::CONFIG_DELIVERYSIGN_IS_ENABLED, $storeScope);
        return $isEnabled;
    }
}
