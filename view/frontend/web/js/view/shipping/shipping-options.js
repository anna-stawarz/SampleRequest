define([
    'uiComponent',
    'ko',
], function (
    Component,
    ko
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Infiright_SampleRequest/sample_request_form/step/shipping/shipping-options',
        },

        toggleOwnShippingAccountOption: ko.observable(false),

        /**
         * @return {exports}
         */
        initialize: function () {
            this._super();

            return this;
        },
    })
});
