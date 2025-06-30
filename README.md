# lumenLaravel1stAPI

# COMO PROTEGER RUTAS de API con JWT y MIDDLEWARE LARAVEL LUMEN PT1
Algo muy comun es que tengamos que proteger las rutas
Ya que, si queremos tener una API privada es que tenmos que generar rutas privadas.

Primero Instalaremos librerias, trabajeremos con token.
Lumen no tiene sesiones, pero si tokens

Una libreria de tokens es jwt.
comando: 
composer require firebase/php-jwt
instala una libreria que nos ayuda a trabajar con jwt.


al finzalizar la instlacion debemos generar nuestro controlador de autenticacion:
php artisan make:controller AuthController

dentro de AuhtContrller genramos primeramente el  

Para poner la data dentro de nuestras rutas

# COMO PROTEGER RUTAS de API con JWT y MIDDLEWARE LARAVEL LUMEN PT2
para proteger las rutas tendremos que hacer uso de un middleware, con:

Debemos imprtar las execiones y los modelos, Jwt, Key de jwt, y expired exception

Lo que debemos hacer es usar handle, para definir las acciones antes y despues del middleware.

