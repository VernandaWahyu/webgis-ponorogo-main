# Webgis Ponorogo Main

Website GIS dengan geolocation dan leaflet routing machine dengan admin stisla bootsrap 5

## Installation Guide

### Siapkan
- PHP >= 8.2
- Composer
- Node.js
- npm
- Laravel 11

### Installation Steps

1. Install composer terlebih dahulu:
    ```bash
    composer install
    ```

2. Install JavaScript :
    ```bash
    npm install && npm run dev
    ```

3. Generate application key:
    ```bash
    php artisan key:generate
    ```

4. Jalankan migrations:
    ```bash
    php artisan migrate
    ```

5. Jalankan Storage link:
    ```bash
    php artisan storage:link
    ```

5. Jalankan untuk memulai website:
    ```bash
    php artisan serve
    ```
