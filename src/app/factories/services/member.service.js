(function () {

    angular.module('demoApp')
        .service("memberService", memberService);

    function memberService($http, CONSTANTS, toastUtilsFactory) {

        return {
            getMembersByFirstnameSurnameEmail: getMembersByFirstnameSurnameEmail
        };
        function getMembersByFirstnameSurnameEmail(firstname, surname, email, callbackSuccess, callbackError) {
            firstname = firstname == undefined ? '' : firstname;
            surname = surname == undefined ? '' : surname;
            email = email == undefined ? '' : email;
            $http.get(CONSTANTS.BACK_CONTROLLER + "Member/member-controller.php" + "?firstname=" + firstname + "&surname=" + surname + "&email=" + email)
                .then(
                    function (response) {
                        // success callback
                        callbackSuccess(response);
                    },
                    function (response) {
                        toastUtilsFactory.showErrorFromResponse(response);
                        // failure callback
                        callbackError(response);
                    }
                );
        }

    }

})();
