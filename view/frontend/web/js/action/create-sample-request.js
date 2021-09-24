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

        var closeModalOnSuccess = function () {
            window.location.href = "/";
        };

        var closeModelOnFailure = function () {
            stepNavigator.goToFirstStep();
        }

        var closeModalHandler = closeModalOnSuccess;

        return storage.post(
            controllerPath,
            params,
            false
        ).done(function (data) {
            modalElem.html(data.message);

            if (data.errors === true) {
                closeModalHandler = closeModelOnFailure;
            }
        }).fail(function (data) {
            if (data.responseJSON && data.responseJSON.hasOwnProperty('message')) {
                modalElem.html(data.responseJSON.message);
            } else {
                modalElem.html($t('Something went wrong.'));
            }

            closeModalHandler = closeModelOnFailure;
        }).always(function () {
            modalElem.modal({
                closed: closeModalHandler
            });

            modalElem.modal('openModal');
        });
    }
});
