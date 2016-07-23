define([
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Catalog/js/price-utils',
    'Magento_Checkout/js/model/totals'

], function (ko, Component, quote, priceUtils, totals) {
    'use strict';
    var show_hide_deliverysign_blockConfig = window.checkoutConfig.show_hide_deliverysign_block;
    var delivery_sign_amount = window.checkoutConfig.delivery_sign_amount;

    return Component.extend({

        totals: quote.getTotals(),
        canVisibleDeliverySignBlock: show_hide_deliverysign_blockConfig,
        getFormattedPrice: ko.observable(priceUtils.formatPrice(delivery_sign_amount, quote.getPriceFormat())),

        isDisplayed: function () {
            return this.getValue() != 0;
        },
        getValue: function() {
            var price = 0;
            if (this.totals()) {
                price = totals.getSegment('fee').value;
            }
            return this.getFormattedPrice(price);
        }
    });
});
