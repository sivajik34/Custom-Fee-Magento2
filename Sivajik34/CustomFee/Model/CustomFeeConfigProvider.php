<?php
namespace Sivajik34\CustomFee\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\ScopeInterface;

class CustomFeeConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfiguration;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger

    )
    {
        $this->scopeConfiguration = $scopeConfiguration;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $deliverySignConfig = [];
        $enabled = $this->scopeConfiguration->getValue('customfee/customfee/status', ScopeInterface::SCOPE_STORE);
        $minimumOrderAmount = $this->scopeConfiguration->getValue('customfee/customfee/minimum_order_amount', ScopeInterface::SCOPE_STORE);
        $deliverySignConfig['fee_label'] = $this->scopeConfiguration->getValue('customfee/customfee/name', ScopeInterface::SCOPE_STORE);
        $quote = $this->checkoutSession->getQuote();
        $subtotal = $quote->getSubtotal();       
        $deliverySignConfig['delivery_sign_amount'] = $this->scopeConfiguration->getValue('customfee/customfee/customfee_amount', ScopeInterface::SCOPE_STORE);
        $deliverySignConfig['show_hide_customfee_block'] = ($enabled && ($minimumOrderAmount <= $subtotal) && $quote->getFee()) ? true : false;
        $deliverySignConfig['show_hide_customfee_shipblock'] = ($enabled && ($minimumOrderAmount <= $subtotal)) ? true : false;
        return $deliverySignConfig;
    }
}
