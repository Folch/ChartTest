(function () {

    angular.module('main')
        .controller('MainController', MainController);

    function MainController(memberService,angularUtilsFactory, $scope) {
        var vm = this;
        // Variables
        vm.currentPage = 1;
        vm.numPerPage = 5;
        vm.labels = [];
        vm.labelsMonth = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        vm.series = ['Sign-ups'];

        vm.data = [];
        vm.dataMonth = [];
        //Methods
        vm.search = search;
        vm.loadPages = loadPages;
        vm.chartClick = chartClick;
        //////////////////////////////////////////
        search('', '', '');
        //////////////////////////////////////////
        function chartClick(bar) {
            vm.showMonthGraph = true;
            var model = bar[0]._model;
            if (model == undefined)return;

            var year = model.label;
            var i;

            var map = new Map();
            var dta = [];
            for (i = 0; i < 12; i++) {
                var s = '';
                if (i < 9) {
                    s = '0';
                }
                map.set(s + (i+1), i);
                dta.push(0);
            }

            var arrMembers = vm.mapMembersYear.get(year);
            for (i = 0; i < arrMembers.length; i++) {
                var member = arrMembers[i];
                var idx = map.get(moment(member.joined_date, 'YYYY-MM-DD').format('MM'));

                dta[idx]++;
            }
            angularUtilsFactory.safeApply($scope, vm.dataMonth = dta);
        }

        function search(firstname, surname, email) {
            memberService.getMembersByFirstnameSurnameEmail(firstname, surname, email, function (response) {
                vm.members = response.data.members;
                calculateDataForGraph(vm.members);
                loadPages();
                vm.showMonthGraph = false;
            }, function (response) {

            });
        }

        function loadPages() {
            if (vm.members == undefined)return;
            var begin = ((vm.currentPage - 1) * vm.numPerPage)
                , end = begin + vm.numPerPage;

            vm.filteredTable = vm.members.slice(begin, end);
            vm.numPages = Math.ceil(vm.members.length / vm.numPerPage);
        }

        function calculateDataForGraph(members) {
            if (members != undefined) {
                var map = new Map();
                vm.mapMembersYear = new Map();
                var i;
                for (i = 0; i < members.length; i++) {
                    var member = members[i];
                    var year = moment(member.joined_date, 'YYYY-MM-DD').format('YYYY');
                    if (map.has(year)) {
                        map.set(year, map.get(year) + 1);
                    } else {
                        map.set(year, 1);
                    }
                    if (vm.mapMembersYear.has(year)) {
                        vm.mapMembersYear.get(year).push(member);
                    } else {
                        vm.mapMembersYear.set(year, [member]);
                    }
                }
                var keys = Array.from(map.keys());
                keys.sort();
                vm.labels = keys;

                var dta = [];
                for (i = 0; i < keys.length; i++) {
                    dta.push(map.get(keys[i]));
                }
                vm.data = dta;
            }

        }
    }
})();
