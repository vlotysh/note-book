'use strict';

angular.module('myApp.routes', ['ngRoute'])

        .config(['$routeProvider', function ($routeProvider) {
                $routeProvider.when('/view1', {
                    templateUrl: 'app/views/View1Ctrl/view1.html',
                    controller: 'View1Ctrl'
                });

                $routeProvider.when('/view2', {
                    templateUrl: 'app/views/View2Ctrl/view2.html',
                    controller: 'View2Ctrl'
                });
            }])

