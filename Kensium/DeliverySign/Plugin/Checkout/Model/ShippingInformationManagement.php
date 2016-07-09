<?php
namespace Kensium\DeliverySign\Plugin\Checkout\Model;
use Magento\Store\Model\ScopeInterface;
class ShippingInformationManagement
{
    protected $quoteRepository;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfiguration;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfiguration
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->scopeConfiguration = $scopeConfiguration;
    }
    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $extAttributes = $addressInformation->getExtensionAttributes();
        $deliverySignature = $extAttributes->getFee();
        $quote = $this->quoteRepository->getActive($cartId);
        if($deliverySignature){
        $fee = $this->scopeConfiguration->getValue('deliverysign/deliverysign/deliverysign_amount', ScopeInterface::SCOPE_STORE);
        $quote->setFee($fee);
        } else{
          $quote->setFee(NULL);
       }       
    }
}

