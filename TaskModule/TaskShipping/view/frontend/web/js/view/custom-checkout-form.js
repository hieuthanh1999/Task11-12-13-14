/*global define*/
define([
    'ko',
    'jquery',
    'uiComponent',
    "mage/url",
    "mage/storage",
    'Magento_Customer/js/model/customer',
    'Magento_Checkout/js/model/quote'
], function(ko, $, Component, urlBuilder,storage, customer, quote) {
    'use strict';
    return Component.extend({
        initialize: function () {
            this._super();
            // component initialization logic
            return this;
        },  

        /**
         * Form submit handler
         *
         * This method can have any price.
         */
        onSubmit: function() {
            var price = document.getElementById('shipping-price').value;
            console.log(price);
            
            var quoteId = quote.getQuoteId();

            var url = urlBuilder.build('taskshipping/price/save');
            storage.post(
                url,
                JSON.stringify({quoteId:quoteId, price: price}),
                false
            ).done(
                function (respone) {
                    console.log(respone);
                }

            ).fail(
            );
        }
    });
});