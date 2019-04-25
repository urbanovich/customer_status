define([
    'jquery',
    'uiComponent',
    'Magento_Ui/js/model/messageList',
], function ($, uiComponent, messageList) {
    'use strict';

    return uiComponent.extend({

        defaults: {
            template: 'Company_CustomerStatus/status',
            customer_status: [],
            statuses: [],
            customerId: [],
        },

        initialize: function () {
            this._super();
        },

        initObservable: function () {
            this._super();

            this.observe(
                'status status_list selected'
            );

            this.status_list(this.statuses);
            this.selected(this.customer_status.status);

            return this;
        },
        
        save: function (status) {

            if (status != this.customer_status.status) {
                messageList.addSuccessMessage({
                    message: 'Wait, please'
                });
                $.ajax({
                    url: '/status/customer/save/',
                    type: 'POST',
                    data: 'status=' + status + '&customer_id=' + this.customerId,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            messageList.addSuccessMessage({
                                message: 'You status has been changed'
                            });
                        }
                    },
                    error: function (response) {
                        messageList.addErrorMessage({
                            message: response
                        });
                    }
                })
            }
        }
    });

});
