# CRUD MVC APLICANDO LOS PRINCIPIOS SOLID

Un gestor de tareas muy cencillo y rápido

## Autores

- [@SrPeriky](https://www.github.com/SrPeriky)


## Despliegue

Para desplegar este proyecto, ejecute

```bash
  git clone https://github.com/SrPeriky/CRUD.git
```
Importar la base de datos `CRUD/prueba.sql`

Configurar la conexion a la base de datos `CRUD/app/config.php`

```php
define('HOST_NAME', 'localhost');
define('DB_NAME', 'prueba');
define('US_NAME', 'root');
define('PSSWORD', '');

...

```
Configurar la URL base `CRUD/app/config.php`

```php

...

define('BASE_URL', 'http://localhost/CRUD/');

...

```

## Tech Stack

**Client:** Bootstrap, Vue.js, jQuery, Font Awesome

**Server:** php
