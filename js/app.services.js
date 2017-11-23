myApp.service('ServiceTest', ServiceTest);

ServiceTest.$inject = ['$q', '$http'];

function ServiceTest($q, $http) {
    this.searchGoogle = searchGoogle;
    this.generarExcel = generarExcel;

    function searchGoogle($cadena) {
    	var def = $q.defer();
        $http({
            method: "GET",
            url: 'https://www.googleapis.com/customsearch/v1?key=AIzaSyBSb_-AYfxAbD_VvMiDQa7Sj8vGIHEW-68&cx=002430856775248971682:z9pccpc5xje&q=' + $cadena
        }).then(function mySuccess(response) {
            def.resolve( response.data);
        }, function myError(error) {
        	 def.reject(error);
        });
      	return def.promise;	
    }

    function generarExcel(data) {
    	var def = $q.defer();
    	$http({
            method: "POST",
            url: 'services/generarExcel.php',
            dataType: "json",
            data: {datos: data},
            headers: {
                'Content-type': 'application/json'
            }
        }).then(function mySuccess(response) {
             def.resolve( response.data);
        }, function myError(error) {
        	def.reject(error);   
        });
      	return def.promise;	
    }
}