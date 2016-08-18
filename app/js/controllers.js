'use strict';

angular.module('myApp.controllers', ['ngRoute'])

        .controller('View2Ctrl', [function () {
                console.log('View2Ctrl');
            }])
        .controller('View1Ctrl', [function () {
                 console.log('View1Ctrl');
            }]);