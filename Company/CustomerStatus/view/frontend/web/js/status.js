define([
    'jquery',
    'uiComponent',
    'Magento_Ui/js/model/messageList'
], function ($, uiComponent, messageList) {
    'use strict';

    return uiComponent.extend({

        defaults: {
            template: 'Company_CustomerStatus/status',
            customer_status: [],
            statuses: [],
        },

        initialize: function () {
            this._super();
        },

        initObservable: function () {
            this._super();

            this.observe(
                'customer_status statuses'
            );

            return this;
        },
    });

});
