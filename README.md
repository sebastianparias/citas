<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requisitos
PHP superior a 7.3  
Composer > v2
mysql  Ver 15.1 Distrib 10.4.27-MariaDB

## Cómo instalar en local
Para clonar esta aplicación a un entorno local, sigue estos pasos:

1. Abre tu terminal y navega al directorio donde quieres clonar la aplicación:
`cd /ruta/al/directorio`

2. Clona el repositorio de la aplicación Laravel existente desde GitHub:
`git clone https://github.com/sebastianparias/citas`

3. Una vez que se haya clonado el repositorio, navega al directorio de la aplicación y abre el editor de código:
`cd citas`  
`code .`

4. Copia el archivo .env.example a un nuevo archivo llamado .env, en windows:
`copy .env.example .env`
Y actualiza los parámetros acorde a la configuración de tu motor de base de datos:

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=citas  
DB_USERNAME=root  
DB_PASSWORD=password  


5. Genera una nueva clave de aplicación usando el siguiente comando:
`php artisan key:generate`

6. Instala las dependencias de la aplicación.
`composer install`

7. Crea la base de datos MySQL con el siguiente código SQL
`CREATE DATABASE citas;`
O ejecuta el archivo "db.sql" incluido en el repositorio.

8. Agrega los detalles de conexión en el archivo .env.

9. Ejecuta las migraciones para crear las tablas de la base de datos:
`php artisan migrate`

10. Inicia el servidor web de desarrollo con el siguiente comando: 
`php artisan serve`
Esto iniciará el servidor web en el puerto 8000 (por defecto). Abre tu navegador web y navega a http://localhost:8000 para acceder a la aplicación.

## Tecnologías
Este proyecto se creó con MySQL, Laravel, HTML, CSS, Bootstrap, FullCalendar y JavaScript.
