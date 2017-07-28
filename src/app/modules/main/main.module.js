/**
 * Created by albert on 9/05/17.
 */
(function () {

    var module = angular.module('main', ['constants']);

    module.config(function ($stateProvider, $locationProvider, $urlMatcherFactoryProvider) {

        $locationProvider.hashPrefix('!');
        $urlMatcherFactoryProvider.strictMode(false);

        $stateProvider
            .state('index',
                {
                    url: '/index',
                    css: [],
                    views: {
                        'content': {
                            templateUrl: 'app/modules/main/main.html',
                            controller: 'MainController as vm'
                        }
                    }
                }
            );
    });

})();