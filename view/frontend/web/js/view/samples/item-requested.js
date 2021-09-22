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
            template: 'Infiright_SampleRequest/sample_request_form/step/samples/item-requested',
        },

        sample_request_items: ko.observableArray([]),
        item_name: ko.observable(''),
        item_note: ko.observable(''),

        /**
         * @return {exports}
         */
        initialize: function () {
            this._super();

            return this;
        },

        addNewItem: function() {
            this.sample_request_items.push({
                item_name:  this.item_name(),
                item_note:  this.item_note(),
            });

            this.item_name('');
            this.item_note('');
        }
    });
});
