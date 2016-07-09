<?php
namespace Kensium\DeliverySign\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddFeeToOrderObserver implements ObserverInterface
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;
   
    /**
     * AddFeeToOrderObserver constructor.
     * @param \Magento\Checkout\Model\Session $checkoutSession
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        $this->_checkoutSession = $checkoutSession;
    }

    /**
     * Set payment fee to order
     *
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
        $DeliverySignFee = $quote->getFee();
        $DeliverySignBaseFee = $quote->getBaseFee();
        if(!$DeliverySignFee || !$DeliverySignBaseFee) {
            return $this;
        }
        //Set fee data to order
        $order = $observer->getOrder();
        $order->setData('fee', $DeliverySignFee);
        $order->setData('base_fee', $DeliverySignBaseFee);

        return $this;
    }
}
