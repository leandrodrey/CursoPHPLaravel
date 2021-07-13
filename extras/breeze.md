<img src="imagenes/breeze.png">

# Laravel Breeze

> Es el kit de inicio de un sistema de login/autenticación automatizado que viene con Laravel. Este te crea las vistas de login/autenticación


## Crear proyecto nuevo

    composer create-project laravel/laravel login-breeze


## Crear Base de datos  
## Configurar el .env

    DB_DATABASE=login-breeze

## Correr migraciones  
> Las migraciones son clases que nos van a servir para crear tablas en una base de datos y configurar los campos en estas tablas.

    php artisan migrate

## Instalar Breeze usando composer

    composer require laravel/breeze --dev

> Este comando descarga los packages necesarios para instalar Breeze y sus dependencias  
> Como aún faltan generar las vistas esto se logra con el comando install

    php artisan breeze:install  

Esta comendo genera las vistas de autenticación, los routes, los controllers y otros recursos de instalación.

> Ahora dejar listo TailwindCSS y algo de Javascript  

     npm install  
     npm run dev 

> webpack compiled successfully