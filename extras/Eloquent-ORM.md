<img src="imagenes/laravel-eloquent-orm.png">

# Eloquent ORM

>Laravel incluye Eloquent, un ORM (object-relational mapper) que simplifica la interacicón con bases de datos.  
>Al utilizar Eloquent, cada tabla de una base de datos tiene su Modelo correspondiente que se emplea para interactuar con dicha tabla.   
>Además de obtener registros de dicha tabla, los modelos de Eloquent posibilitan simplificaciones de inseción, modificación, y eliminación de registros de la tabla en cuestión.

## Generación de clases de Modelos

    php artisan make:model Nombre  

## Convenciones de nombres de Modelos

> Los nombres de las tablas utilizan un sistema de plurales, si necesitamos modificarlos, tenemos el atributo $table.

    protected $table = 'mi_tabla';  

> De manera predeterminada, Eloquent espera que todas las tablas de tu base de datos tengan los campos "created_at" y "updated_at"; y por lo tanto el modelo conlleva esta convensión.   
> Cuando se cree o modifique un modelo, Eloquena seteará los valores en estos campos.   
> Si no queremos que Eloquent opere con estos campos, o bien si no queremos modificar la estructura de nuestras tablas,debemos definir el atributo público $timestamps de nuestro modelo con el valor false.

    public $timestamps = false;  