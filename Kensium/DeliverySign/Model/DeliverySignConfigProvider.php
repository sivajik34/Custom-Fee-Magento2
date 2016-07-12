<?php
namespace Kensium\DeliverySign\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\ScopeInterface;

class DeliverySignConfigProvider implements ConfigProviderInterface
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
        $enabled = $this->scopeConfiguration->getValue('deliverysign/deliverysign/status', ScopeInterface::SCOPE_STORE);
        $minimumOrderAmount = $this->scopeConfiguration->getValue('deliverysign/deliverysign/minimum_order_amount', ScopeInterface::SCOPE_STORE);
        $quote = $this->checkoutSession->getQuote();
        $subtotal = $quote->getSubtotal();
        $this->logger->addDebug($subtotal);
        $deliverySignConfig['delivery_sign_amount'] = $this->scopeConfiguration->getValue('deliverysign/deliverysign/deliverysign_amount', ScopeInterface::SCOPE_STORE);
        $deliverySignConfig['show_hide_deliverysign_block'] = ($enabled && ($minimumOrderAmount <= $subtotal) && $quote->getFee()) ? true : false;
        $deliverySignConfig['show_hide_deliverysign_shipblock'] = ($enabled && ($minimumOrderAmount <= $subtotal)) ? true : false;
        return $deliverySignConfig;
    }
}
