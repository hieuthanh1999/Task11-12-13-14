define(
    [
        'ko',
        'jquery',
        'uiComponent',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/quote',
        "mage/url",
        "mage/storage"
    ],
    function (ko, $, Component, customer, quote, urlBuilder,storage) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'TaskModule_TaskAttributeOrder/checkout/customCheckbox'
            },

            initialize: function () {
                this.textname = ko.observable('');
                this._super();
            },

            apply: function () {
                var name = document.getElementById('orderby').value;
                console.log(name);
                
                // var quoteId = quote.getQuoteId();

                var url = urlBuilder.build('taskattributeorder/product/index');
                storage.post(
                    url,
                    JSON.stringify({name: name}),
                    false
                ).done(
                    function (respone) {
                        console.log(respone);
                    }
    
                ).fail(
                );
                
            }
        });
    }
);