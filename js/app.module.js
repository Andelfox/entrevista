var myApp = angular.module('myApp', ['ngRoute', 'ngTagsInput']);

myApp.config(function ($routeProvider) {
    $routeProvider
            .when('/', {
                templateUrl: 'views/home.html',
                controller: 'controllerEntrevista'
            })

});
