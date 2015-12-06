define([
    'uiComponent'

], function (Component) {
    'use strict';
 var show_hide_custom_blockConfig = window.checkoutConfig.show_hide_custom_block;

    return Component.extend({
        defaults: {
            template: 'Kensium_DeliverySign/checkout/shipping/delivery-signature'
        }
,
        canVisibleDeliverySignBlock: show_hide_custom_blockConfig
    });
});
