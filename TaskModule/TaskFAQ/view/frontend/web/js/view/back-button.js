define(["ko", "jquery", "uiComponent", "Magento_Ui/js/modal/modal"], function (ko, $, Component, modal) {
  ("use strict");
  return Component.extend({
    defaults: {
      template: "TaskModule_TaskFAQ/back-button",
    },
    initialize: function () {
      this._super();
     
    },

    test: function () {
      // alert('adsd');
      var options = {
        type: 'popup',
        responsive: true,
        title: 'Main title',
        buttons: [{
            text: $.mage.__('Ok'),
            class: '',
            click: function () {
                this.closeModal();
            }
        }]
    };

    var popup = modal(options, $('#modal'));
      $("#modal").modal('openModal');
     
    },
  });
  
});
