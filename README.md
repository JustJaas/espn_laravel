# ESPN API Laravel

## Descripción

Esta aplicación usa el API del siguiente link `http://sports.core.api.espn.com/v2/sports`, la cual tiene como objetivo principal obtener y importar información sobre los deportes, ligas, equipos y temporadas.

## Instalación

1. Clona este repositorio: `git clone https://github.com/JustJaas/espn_laravel.git`
2. Navega a la carpeta del proyecto: `cd espn_laravel`
3. Instala las dependencias: `composer install`
4. Cambia el nombre al archivo `.env.example` a `.env`
5. Genera una `APP_KEY` con el siguiente comando `php artisan key:generate`
6. Crear la base de datos: `php artisan migrate`
7. Inicia el server `php artisan serve`

## Uso desde la terminal

1. Inicia las colas `php artisan queue:listen`
2. Ejecuta las una de las opciones:
    - `php artisan app:sport soccer`: comando por deporte.
    - `php artisan app:league uefa.champions`: comando por liga.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
