# lumenLaravel1stAPI

## COMO PROTEGER RUTAS de API con JWT y MIDDLEWARE LARAVEL LUMEN PT1
Algo muy comun es que tengamos que proteger las rutas
Ya que, si queremos tener una API privada es que tenmos que generar rutas privadas.

Primero Instalaremos librerias, trabajeremos con token.
Lumen no tiene sesiones, pero si tokens

Una libreria de tokens es jwt.
comando: 
composer require firebase/php-jwt
instala una libreria que nos ayuda a trabajar con jwt.


al finalizar la instalacion debemos generar nuestro controlador de autenticacion:
php artisan make:controller AuthController

dentro de AuthController generamos primeramente el  

Para poner la data dentro de nuestras rutas

## COMO PROTEGER RUTAS de API con JWT y MIDDLEWARE LARAVEL LUMEN PT2
para proteger las rutas tendremos que hacer uso de un middleware, con:
php artisan make:middleware JwtMiddleware

Debemos importar las excepsiones y los modelos, Jwt, Key de jwt, y expired exception

Lo que debemos hacer es usar handle, para definir las acciones antes y despues del middleware.

## G
generaremos una nueva ruta 

php artisan make:migration change_length_password_field

# INICIO 
composer i
generar el archivo .env
    DB_CONNECTION=sqlite
    JWT_SECRET=
php artisan key:generate
php artisan migrate
php artisan serve
