define([
    'jquery',
], function ($) {
    'use strict';

    return {
        sampleRequestData: {},

        setFormData: function (formId) {
            var self = this;
            var form = $('.' + formId);
            var isValid = form.validation() && form.validation('isValid');

            if (isValid) {
                var formData = form.serializeArray();

                formData.forEach(function (entry) {
                    self.sampleRequestData[entry.name] = entry.value;
                    localStorage.setItem(entry.name, entry.value);
                });

                self.sampleRequestData = this.convertBracketsNotationDataToSubObjects(self.sampleRequestData);
            }

            return isValid;
        },

        getAllSampleRequestFormData: function () {
            return this.sampleRequestData;
        },

        convertBracketsNotationDataToSubObjects: function (sampleRequestData) {
            var plain = sampleRequestData;

            Object.keys(plain).forEach(function (k) {
                var path = k.replace(/\[/g, '.').replace(/\]/g, '').split('.'),
                    last = path.pop();

                if (path.length) {
                    path.reduce(function (o, p) {
                        return o[p] = o[p] || {};
                    }, plain)[last] = plain[k];
                    delete plain[k];
                }
            });

            return plain;
        }
    }
});
