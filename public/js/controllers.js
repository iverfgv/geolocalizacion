var app = angular.module('aplicacion', []);

app.controller('InstrumentosListadoCtrl', function ($scope) {
    
	$scope.model = [
        { marca: 'Fender', nombre: 'Fender Squier Vibe 60', precio: 400},
        { marca: 'Ibanez', nombre: 'Ibanez 350 EX', precio: 450},
        { marca: 'Schecter', nombre: 'Schecter Omen Extreme 6', precio: 500},
        { marca: 'Nissan', nombre: 'Datos Extars', precio: 800},
    ];
	
	$scope.registrar = function(){
		if(typeof($scope.marca) !== 'undefined' && typeof($scope.nombre) !== 'undefined' && typeof($scope.precio) !== 'undefined'){
			if(!isNaN(parseFloat($scope.precio))){
				$scope.model.push(
					{ marca: $scope.marca, nombre: $scope.nombre, precio: $scope.precio }
				);
				
				// Limpia
				$scope.marca = 'Bien';
				$scope.nombre = null;
				$scope.precio = null;
			}
		}
    return false;
   }
   
   $scope.retirar = function($index){
      if(confirm("¿Estas seguro de eliminar el registro?"))    
	     $scope.model.splice($index, 1);
   }

});


app.controller('InstrumentoRegistrarCtrl', function($scope){});
app.controller('InstrumentoActualizarCtrl', function($scope){});
app.controller('InstrumentoVisualizarCtrl', function($scope){});
app.controller('InstrumentoEliminarCtrl', function($scope){});


