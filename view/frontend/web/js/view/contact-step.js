define([
    'jquery',
    'underscore',
    'Magento_Ui/js/form/form',
    'ko',
    'uiRegistry',
    'mage/translate',
    'Infiright_SampleRequest/js/model/step-navigator',
    'Infiright_SampleRequest/js/model/form-request'
], function (
    $,
    _,
    Component,
    ko,
    registry,
    $t,
    stepNavigator,
    fromRequest
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Infiright_SampleRequest/sample_request_form/step/contact',
            formClass: 'form-contact-step'
        },

        visible: ko.observable(true),

        initialize: function () {
            this._super();

            stepNavigator.registerStep(
                'contact',
                $t('Contact'),
                'Contact Information',
                this.visible,
                _.bind(this.navigate, this),
                this.sortOrder
            );

            return this;
        },


        /**
         * @param newValue
         * @returns {boolean|*}
         */
        isVisible: function(newValue) {
            if (newValue !== 'undefined') {
                self.visible = newValue;
            }

            return self.visible;
        },

        setContactInformation: function () {
            var valid = fromRequest.setFormData(this.formClass);
            if (valid) {
                stepNavigator.next();
            }
        },

        /**
         * Navigator change hash handler.
         *
         * @param {Object} step - navigation step
         */
        navigate: function (step) {
            step && step.isVisible(true);
        },
    })
});
