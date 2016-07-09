define([
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils'

    ], function (ko, Component, quote, priceUtils) {
        'use strict';
        var show_hide_deliverysign_blockConfig = window.checkoutConfig.show_hide_deliverysign_block;       
        var delivery_sign_amount = window.checkoutConfig.delivery_sign_amount;        

        return Component.extend({
           
            canVisibleDeliverySignBlock: show_hide_deliverysign_blockConfig,
            getFormattedPrice: ko.observable(priceUtils.formatPrice(delivery_sign_amount, quote.getPriceFormat()))
        });
    });
