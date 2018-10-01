var app = angular.module('bb45trans', []);


app.controller('login', function($scope, $http, $timeout, $window, $location){
    $scope.email = null;
    $scope.password = null;
    $scope.response = false;
    $scope.responsClass = null;
    $scope.responsAlert = null;

    $scope.loginPost = function(){
        var data = {
            email: $scope.email,
            password: $scope.password
        };
        $http.post('/auth/login_act', data)
            .then(function(res, status){
               $scope.response = true;
               if(res.data.status == true){
                   $scope.responsClass = 'alert-success';
                   $scope.responsAlert = 'Login success, redirecting...';
                   $timeout(function(){
                       $window.location.reload();
                   }, 1000);
               }else{
                    $scope.responsClass = 'alert-danger';
                    $scope.responsAlert = 'Login failed, please check your email and password';
               }
            })
    }

});