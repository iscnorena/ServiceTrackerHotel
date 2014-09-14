##SERVICE TRACKER

Service Tracker es una aplicación web diseñada para el seguimiento de incidentes (tickets),  está diseñado para ayudar a registrar, dar seguimiento y finalmente solucionar todos los requerimientos que puedan llegar a surgir, garantizando la satisfacción de los Huéspedes.

## Instalación 

Ejecutar desde consola el siguiente comando, ubicándonos  dentro de la carpeta “www” para el caso de wamp.

	composer create-project laravel/laravel nombreproyecto

##Crear la base de datos

	SET time_zone = '-06:00';
	CREATE DATABASE IF NOT EXISTS servicetrackerhotel2014 CHARACTER SET latin1 COLLATE latin1_spanish_ci;

## Agregar componentes

	composer update --dev
	
	php artisan debugbar:publish
	php artisan config:publish barryvdh/laravel-dompdf

## Crear migraciones

	php artisan migrate:install
	php artisan migrate

## Crear datos de prueba

	php artisan db:seed
## Bienvenido

Si tuvimos suerte veras lo siguiente.

<img src="https://github.com/iscnorena/ServiceTrackerHotel/blob/master/public/img/welcome.png"/>

usuario: admin y clave:admin

<img src="https://github.com/iscnorena/ServiceTrackerHotel/blob/master/public/img/index.png"/>

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
