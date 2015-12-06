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
        $showHide = [];
        $enabled = $this->scopeConfiguration->getValue('deliverysign/deliverysign/status', ScopeInterface::SCOPE_STORE);
        $showHide['show_hide_custom_block'] = ($enabled)?true:false;
        return $showHide;
    }
}
