'use strict';

PLUGIN
    .config(['$stateProvider', function ($stateProvider) {
        $stateProvider
            .state('login', {
                url: '/login',
                views: {
                    'layout': {
                        templateUrl: '/matrix/login'
                    }
                }
            });
    }])
    .constructor('MatrixLoginCtrl', ['$scope', '$q', 'appServices', function ($scope, $q, appServices) {
        appServices.init('matrixLogin');

        $scope.data = {};

        // 验证邮箱字段
        $scope.checkEmail = function (email) {
            return $q(function (resolve, reject) {
                appServices.matrixLogin.check('email', email).then(resolve, reject);
            });
        };
        // 验证密码字段
        $scope.checkPassword = function (str) {
            return /^\w{6,30}$/.test(str);
        };
    }])
    .service('matrixLogin', ['$http', '$q', '$state', function ($http, $q, $state) {
        // 检测字段是否存在
        this.check = function (field, value) {
            let that = this;
            return $q(function (resolve, reject) {
                $http.get('/matrix/login?action=check&field=' + encodeURI(field) + '&value=' + encodeURI(value))
                    .success(function (data) {
                        data.exists ? resolve(data) : reject();
                    })
                    .error(function () {
                        reject();
                    });
            });
        };

        // 提交登录
        this.login = function (data) {
            let that = this;
            $http.post('/matrix/login', data).then(
                function () {
                    $state.go('app.index');
                }, function () {
                    toastr.error('登录失败');
                }
            );
        };
    }]);