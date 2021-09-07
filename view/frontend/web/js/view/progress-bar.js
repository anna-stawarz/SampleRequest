define([
    'jquery',
    'underscore',
    'ko',
    'uiComponent',
    'Infiright_SampleRequest/js/model/step-navigator',
], function ($, _, ko, Component, stepNavigator) {
    'use strict';

    var steps = stepNavigator.steps;

    return Component.extend({
        defaults: {
            template: 'Infiright_SampleRequest/sample_request_form/step/progress-bar',
            visible: true
        },
        steps: steps,

        initialize: function () {
            var stepsValue;

            this._super();
            window.addEventListener('hashchange', _.bind(stepNavigator.handleHash, stepNavigator));

            if (!window.location.hash) {
                stepsValue = stepNavigator.steps();

                if (stepsValue.length) {
                    stepNavigator.setHash(stepsValue.sort(stepNavigator.sortItems)[0].code);
                }
            }

            stepNavigator.handleHash();
        },

        /**
         * @param {*} itemOne
         * @param {*} itemTwo
         * @return {*|Number}
         */
        sortItems: function (itemOne, itemTwo) {
            return stepNavigator.sortItems(itemOne, itemTwo);
        },

        /**
         * @param {Object} step
         */
        navigateTo: function (step) {
            stepNavigator.navigateTo(step.code);
        },

        /**
         * @param {Object} item
         * @return {*|Boolean}
         */
        isProcessed: function (item) {
            return stepNavigator.isProcessed(item.code);
        }
    });
});
