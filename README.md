# Requisitos
* Laravel ^8.54
* PHP ^7.3|^8.0
* Bootstrap ^5.0

# Instalación requisitos(Opcional)
* Laravel -> https://laravel.com/docs/8.x
* PHP -> https://www.apachefriends.org/es/index.html
* Bootstrap -> https://www.neoguias.com/instalar-bootstrap-laravel/

# Instalación del proyecto

```.bash
composer install
```
```.bash
composer update
```
```.bash
npm install
```

Para la obtención de la base de datos se crea una base de datos en el servidor y se ejecutan migraciones

```.bash
php artisan migrate --seed
```

En el caso que se necesite regresar a la base de datos original

```.bash
php artisan migrate:refresf --seed
```


Ejecutar el programa

```.bash
php artisan serve
```
