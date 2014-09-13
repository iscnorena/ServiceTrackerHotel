## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

##SERVICE TRACKER

Service Tracker es una aplicación web diseñada para el seguimiento de incidentes (tickets),  está diseñado para ayudar a registrar, dar seguimiento y finalmente solucionar todos los requerimientos que puedan llegar a surgir, garantizando la satisfacción de los Huéspedes.

## Instalación 

Ejecutar desde consola el siguiente comando, ubicándonos  dentro de la carpeta “www” para el caso de wamp.

	composer create-project laravel/laravel nombreproyecto

##Crear la base de datos

	SET time_zone = '-06:00';
	CREATE DATABASE IF NOT EXISTS servicetrackerhotel2014 CHARACTER SET latin1 COLLATE latin1_spanish_ci;

## Agregar componentes

Ejecutamos
	composer update --dev
	
y ejecutar
	php artisan debugbar:publish
	php artisan config:publish barryvdh/laravel-dompdf

## Crear migraciones

	php artisan migrate:install
	php artisan migrate

## Crear datos de prueba

importante generar un seed a la vez por lo tanto en app/database/seed/DatabaseSeeder descomentar un seed y ejecutamos.
	php artisan db:seed
Volvemos a comentarlo y descomentar otro y así sucesivamente.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
