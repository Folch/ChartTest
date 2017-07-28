(function () {

    angular.module('demoApp')
        .service("toastUtilsFactory", toastUtilsFactory);

    function toastUtilsFactory($mdToast) {
        var last = {
            bottom: false,
            top: true,
            left: false,
            right: true
        };

        var toastPosition = angular.extend({}, last);

        return {
            showSimpleToast: showSimpleToast,
            showErrorFromResponse: showErrorFromResponse
        };

        function getToastPosition() {
            sanitizePosition();

            return Object.keys(toastPosition)
                .filter(function (pos) {
                    return toastPosition[pos];
                })
                .join(' ');
        }

        function sanitizePosition() {
            var current = toastPosition;

            if (current.bottom && last.top) current.top = false;
            if (current.top && last.bottom) current.bottom = false;
            if (current.right && last.left) current.left = false;
            if (current.left && last.right) current.right = false;

            last = angular.extend({}, current);
        }

        function showSimpleToast(msg) {
            var pinTo = getToastPosition();

            $mdToast.show(
                $mdToast.simple()
                    .textContent(msg)
                    .position(pinTo)
                    .hideDelay(3000)
            );
        }

        function showErrorFromResponse(response) {
            var pinTo = getToastPosition();

            var c = response.data.cause !== undefined && response.data.cause !== null ? response.data.cause : response.data.error;

            $mdToast.show(
                $mdToast.simple()
                    .textContent(c)
                    .position(pinTo)
                    .hideDelay(10000)
            );
        }

    }

})();
