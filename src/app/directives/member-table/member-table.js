(function () {

    angular
        .module('demoApp')
        .directive('table', MemberTable);

    function MemberTable() {

        return {
            restrict: 'EA', //Default in 1.3+
            scope: {
                ngModel: '='//variable, @ string, & function
            },
            require: ['ngModel'],
            controllerAs: 'vm',
            replace: true,
            bindToController: true, //required in 1.3+ with controllerAs
            controller: Controller,
            templateUrl: '/app/directives/member-table/member-table.html'

        };


        function Controller() {
            var vm = this;

            // Variables
            vm.ngModel = vm.ngModel || [];
            //Methods
            //////////////////////////

            //////////////////////////
        }
    }
})();

