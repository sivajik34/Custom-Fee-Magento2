<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kensium\DeliverySign\Model\Total;

use Magento\Store\Model\ScopeInterface;

class Fee extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfiguration;

    /**
     * Collect grand total address amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     */
    protected $quoteValidator = null;

    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration)
    {
        $this->quoteValidator = $quoteValidator;
        $this->scopeConfiguration = $scopeConfiguration;
    }

    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    )
    {
        parent::collect($quote, $shippingAssignment, $total);

        $enabled = $this->scopeConfiguration->getValue('deliverysign/deliverysign/status', ScopeInterface::SCOPE_STORE);
        $minimumOrderAmount = $this->scopeConfiguration->getValue('deliverysign/deliverysign/minimum_order_amount', ScopeInterface::SCOPE_STORE);
        $subtotal = $total->getTotalAmount('subtotal');
        if ($enabled) {
            $exist_amount = 0; //$quote->getFee();
            $fee = $this->scopeConfiguration->getValue('deliverysign/deliverysign/deliverysign_amount', ScopeInterface::SCOPE_STORE);

            $balance = $fee - $exist_amount;

            $total->setTotalAmount('fee', $balance);
            $total->setBaseTotalAmount('fee', $balance);

            $total->setFee($balance);
            $total->setBaseFee($balance);

            $total->setGrandTotal($total->getGrandTotal() + $balance);
            $total->setBaseGrandTotal($total->getBaseGrandTotal() + $balance);
        }

        return $this;
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return array
     */
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        $enabled = $this->scopeConfiguration->getValue('deliverysign/deliverysign/status', ScopeInterface::SCOPE_STORE);
        $minimumOrderAmount = $this->scopeConfiguration->getValue('deliverysign/deliverysign/minimum_order_amount', ScopeInterface::SCOPE_STORE);
        $subtotal = $total->getTotalAmount('subtotal');
        if ($enabled ) {
        $fee = $this->scopeConfiguration->getValue('deliverysign/deliverysign/deliverysign_amount', ScopeInterface::SCOPE_STORE);
        return [
            'code' => 'fee',
            'title' => 'Delivery Sign Fee',
            'value' => $fee
        ];
        }else {
            return array();
        }
    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Delivery Sign Fee');
    }

    /**
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     */
    protected function clearValues(\Magento\Quote\Model\Quote\Address\Total $total)
    {
        $enabled = $this->scopeConfiguration->getValue('deliverysign/deliverysign/status', ScopeInterface::SCOPE_STORE);
        $minimumOrderAmount = $this->scopeConfiguration->getValue('deliverysign/deliverysign/minimum_order_amount', ScopeInterface::SCOPE_STORE);
        $subtotal = $total->getTotalAmount('subtotal');
            $total->setTotalAmount('subtotal', 0);
            $total->setBaseTotalAmount('subtotal', 0);
            $total->setTotalAmount('tax', 0);
            $total->setBaseTotalAmount('tax', 0);
            $total->setTotalAmount('discount_tax_compensation', 0);
            $total->setBaseTotalAmount('discount_tax_compensation', 0);
            $total->setTotalAmount('shipping_discount_tax_compensation', 0);
            $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
            $total->setSubtotalInclTax(0);
            $total->setBaseSubtotalInclTax(0);

    }
}
