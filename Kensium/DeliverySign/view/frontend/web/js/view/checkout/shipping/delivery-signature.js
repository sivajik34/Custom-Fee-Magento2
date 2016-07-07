
define([
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils'

    ], function (ko, Component, quote, priceUtils) {
        'use strict';
        var show_hide_deliverysign_blockConfig = window.checkoutConfig.show_hide_deliverysign_block;
        var minimum_order_amount = window.checkoutConfig.minimum_order_amount;
        var delivery_sign_amount = window.checkoutConfig.delivery_sign_amount;
        var totals = quote.getTotals()();
        var subtotal = 0;
        if (totals) {
           subtotal = totals.subtotal;
        }
        return Component.extend({
            defaults: {
                template: 'Kensium_DeliverySign/checkout/shipping/delivery-signature'
            },
            canVisibleDeliverySignBlock: show_hide_deliverysign_blockConfig,
            getFormattedPrice: ko.observable(priceUtils.formatPrice(delivery_sign_amount, quote.getPriceFormat()))
        });
    });
