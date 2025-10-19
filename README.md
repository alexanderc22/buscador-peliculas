# Laravel Buscador de Peliculas

Este proyecto es una **API de búsqueda de películas** desarrollada con **Laravel 12**, que permite obtener información de películas a través de parámetros como `título` y `año`.

## Características principales

- API REST desarrollada en Laravel 12.x
- Endpoint para búsqueda de películas (`/api/movies/search`)
- Arquitectura limpia y organizada (controladores, rutas, vistas)
- Configuración simple y lista para correr en entorno local

---

## Requisitos previos

Antes de ejecutar este proyecto, debe de tener instalado:

- PHP >= 8.2  
- Composer  
- MySQL 
- Laravel CLI (`composer global require laravel/installer`)

---

## Instalación

1. Clonar el repositorio:
   
   git clone https://github.com/usuario/laravel-movies-api.git
   cd laravel-movies-api

2. Instala las dependencias:   
    composer install
3. Crea el archivo de entorno:
    cp .env.example .env
4. Genera la clave de la aplicación:
    php artisan key:generate
5. Configura la base de datos en el archivo .env, por ejemplo:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=movies_api
    DB_USERNAME=root
    DB_PASSWORD=pass
6. Configura onsumo de API KEY www.omdbapi.com/
    OMDB_API_KEY=key_generada_de_omdbapi
    OMDB_API_URL=https://www.omdbapi.com/
7. Ejecuta las migraciones:
    php artisan migrate
8. Inicia el servidor de desarrollo:
    php artisan serve
## Endpoint disponible
- Buscar películas
- URL: http://127.0.0.1:8000/api/movies/search
- Método: GET
- Parámetros disponibles:

    Parámetro	Tipo	    Descripción
    q	        string	    Título de la película a buscar
    year	    int	        Año de lanzamiento (opcional)


- Ejemplo de solicitud:
  GET /api/movies/search?q=matrix&year=1999

- Ejemplo de Respuesta
   {
        "title": "The Matrix",
        "year": "1999",
        "genre": "Action, Sci-Fi",
        "director": "Lana Wachowski, Lilly Wachowski"
    }

## Tecnologías utilizadas

- Laravel 12
- PHP 8.2
- Composer
- (Opcional) Laravel Sail o Docker para entornos de desarrollo

## Autor
    Alexander Cruz
    Desarrollador Web PHP / Laravel
    alexander.cruz.ing@gmail.com