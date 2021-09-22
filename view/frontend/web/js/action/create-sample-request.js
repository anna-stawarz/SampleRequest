define([
    'jquery',
    'ko',
    'mage/storage',
    'Infiright_SampleRequest/js/model/step-navigator',
    'mage/translate'
], function ($, ko, storage, stepNavigator, $t) {
    'use strict';

    return function (saveData) {
        var controllerPath = window.sampleRequestConfig.sampleRequestFormDataSavePath;
        var params = ko.toJSON(saveData);
        var modalElem = $('#modal-sample-request');

        return storage.post(
            controllerPath,
            params,
            false
        ).done(function (data) {
            modalElem.html(data.message);

            modalElem.modal({
                closed: function () {
                    window.location.href = "/";
                    localStorage.clear();
                }
            });
        }).fail(function (data) {
            if (data.responseJSON && data.responseJSON.hasOwnProperty('message')) {
                modalElem.html(data.responseJSON.message);
            } else {
                modalElem.html($t('Something went wrong.'));
            }

            modalElem.modal({
                closed: function () {
                    stepNavigator.goToFirstStep();
                }
            });
        }).always(function() {
            modalElem.modal('openModal');
        });
    }
});
