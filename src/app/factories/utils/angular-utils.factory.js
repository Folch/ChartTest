/**
 * Created by albert on 10/05/17.
 */
(function () {

    angular.module('demoApp')
        .factory("angularUtilsFactory", angularUtilsFactory);

    function angularUtilsFactory() {

        return {
            safeApply: safeApply
        };

        function safeApply($scope, fn) {
            var phase = $scope.$root.$$phase;
            if (phase == '$apply' || phase == '$digest') {
                if (fn && (typeof(fn) === 'function')) {
                    fn();
                }
            } else {
                $scope.$apply(fn);
            }
        }
    }
})();