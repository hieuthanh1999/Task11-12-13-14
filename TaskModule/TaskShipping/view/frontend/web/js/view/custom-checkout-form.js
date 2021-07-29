/*global define*/
define([
    'ko',
    'jquery',
    'uiComponent',
    "mage/url",
    "mage/storage",
    'Magento_Customer/js/model/customer',       
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/shipping-rate-registry',
    'Magento_Checkout/js/model/shipping-service',
    'Magento_Ui/js/block-loader'
], function(ko, $, Component, urlBuilder,storage, customer, quote, rateRegistry, shippingService, blockLoader) {

    $(document).ready(function() {
    //     $("input[name=ko_unique_3]").on( "change", function() {
    //         var test = $(this).val();
    //         $("#form-shipping"+test).show();
    //    } );
   // alert("dsadsa");
    $('shipping-price').hide();
    });

    'use strict';
    return Component.extend({
        initialize: function () {
            this._super();
            // component initialization logic
           
            return this;
           
        },  

        selectShippingMethod: function(){
            alert('dsadsad');
        },
        /**
         * Form submit handler
         *
         * This method can have any price.
         */
        onSubmit: function() {
            var price = document.getElementById('shipping-price').value;
            // console.log(price);
            
            var quoteId = quote.getQuoteId(); 
            var url = urlBuilder.build('taskshipping/price/save');
            // shippingService.isLoading(true);
            
            return storage.post(
                url,
                JSON.stringify({quoteId:quoteId, price: price}),
                false
            ).done(
                function (respone) {
                    blockLoader("<?= $block->escapeJs($block->escapeUrl($block->getViewFileUrl('images/loader-1.gif'))) ?>");
                    return url.setBaseUrl('<?= $block->escapeJs($block->escapeUrl($block->getBaseUrl())) ?>');
                    stepNavigator.next();
                }
            ).fail(
                
            ).always(
                function () {
                    shippingService.isLoading(false);
                }
            );
        }
    });
});