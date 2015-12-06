define([
    'uiComponent'

], function (Component) {
    'use strict';
 var show_hide_deliverysign_blockConfig = window.checkoutConfig.show_hide_deliverysign_block;
 var minimum_order_amount = window.checkoutConfig.minimum_order_amount;
 var delivery_sign_amount = window.checkoutConfig.delivery_sign_amount;
    return Component.extend({
        defaults: {
            template: 'Kensium_DeliverySign/checkout/shipping/delivery-signature'
        }
,
        canVisibleDeliverySignBlock: show_hide_deliverysign_blockConfig
    });
});
