(function () {

    var demoApp = angular.module('demoApp',
        ['dependencies',

            'main'
        ]);

    demoApp.config(function ($stateProvider, $locationProvider, $urlRouterProvider, $mdThemingProvider, $mdDateLocaleProvider) {

        var myRed = $mdThemingProvider.extendPalette('red', {
            '500': '#9A000F'
        });

        $mdThemingProvider.definePalette('myRed', myRed);

        // Use that theme for the primary intentions
        $mdThemingProvider.theme('default')
            .primaryPalette('myRed')
            .accentPalette('red');

        $mdDateLocaleProvider.formatDate = function (date) {
            var tempDate = moment(date);
            return (tempDate.isValid() ? tempDate.format('DD/MM/YYYY') : '');
        };

        $urlRouterProvider.when('', '/index');
        $urlRouterProvider.otherwise("/");


        $locationProvider.html5Mode(false);
    });
})();