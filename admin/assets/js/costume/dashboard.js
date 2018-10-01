var app = angular.module('bb45trans', []);

app.controller('menuCtrl', function($scope, $http){
    angular.element(document.querySelector("#menuDashboard")).addClass("active");
})

app.controller('latest_tour', function($scope, $http){
    $scope.loading = true;
    $http.get('/welcome/latest_tour')
    .then(function(response){
        $scope.tours = response.data;
        $scope.loading = false;
    })
});

app.controller('latest_confirm', function($scope, $http, $timeout){
    $scope.loading = true;
    $timeout(function(){
        $http.get('/welcome/latest_confirm')
        .then(function(response){
            $scope.confirm = response.data;
            $scope.loading = false;
        })
    }, 500);
});

app.controller('latest_blog', function($scope, $http, $timeout){
    $scope.loading = true;
    $timeout(function(){
        $http.get('/welcome/latest_blog')
        .then(function(response){
            $scope.blogs = response.data;
            $scope.loading = false;
        })
    }, 1000);
});

