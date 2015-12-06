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
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
    ) {
        $this->scopeConfiguration = $scopeConfiguration;
    }
    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $deliverySignConfig = [];
        $enabled = $this->scopeConfiguration->getValue('deliverysign/deliverysign/status', ScopeInterface::SCOPE_STORE);
        $deliverySignConfig['minimum_order_amount'] = $this->scopeConfiguration->getValue('deliverysign/deliverysign/minimum_order_amount', ScopeInterface::SCOPE_STORE);
        $deliverySignConfig['delivery_sign_amount'] = $this->scopeConfiguration->getValue('deliverysign/deliverysign/deliverysign_amount', ScopeInterface::SCOPE_STORE);
        $deliverySignConfig['show_hide_deliverysign_block'] = ($enabled)?true:false;
        return $deliverySignConfig;
    }
}
