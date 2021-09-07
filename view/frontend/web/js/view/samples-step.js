define([
    'jquery',
    'underscore',
    'Magento_Ui/js/form/form',
    'ko',
    'uiRegistry',
    'mage/translate',
    'Infiright_SampleRequest/js/model/step-navigator',
    'Infiright_SampleRequest/js/model/create-sample-request',
    'Infiright_SampleRequest/js/model/form-request'
], function (
    $,
    _,
    Component,
    ko,
    registry,
    $t,
    stepNavigator,
    createSampleRequest,
    formRequest
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Infiright_SampleRequest/sample_request_form/step/samples',
            formClass: 'form-sample-step'
        },

        initialize: function () {
            var self = this;
            this._super();
            self.visible = ko.observable(false);

            stepNavigator.registerStep(
                'samples',
                $t('Samples'),
                'Sample Request',
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

        setSampleInformation: function() {
            var valid = formRequest.setFormData(this.formClass);

            if (valid) {
                createSampleRequest.submitRequestForm(formRequest.getAllSampleRequestFormData());
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
