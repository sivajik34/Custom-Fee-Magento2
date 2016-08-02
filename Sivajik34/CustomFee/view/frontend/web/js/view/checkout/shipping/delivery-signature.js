
define([
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils'

    ], function (ko, Component, quote, priceUtils) {
        'use strict';
        var show_hide_customfee_blockConfig = window.checkoutConfig.show_hide_customfee_shipblock;
        var fee_label = window.checkoutConfig.fee_label;         
        var delivery_sign_amount = window.checkoutConfig.delivery_sign_amount;     
        
        return Component.extend({
            defaults: {
                template: 'Sivajik34_CustomFee/checkout/shipping/delivery-signature'
            },
            canVisibleCustomFeeBlock: show_hide_customfee_blockConfig,
            getFormattedPrice: ko.observable(priceUtils.formatPrice(delivery_sign_amount, quote.getPriceFormat())),
            getFeeLabel:ko.observable(fee_label)
        });
    });
