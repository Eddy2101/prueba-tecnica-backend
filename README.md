# Proyecto Backend

## Requisitos
1. Laravel v12
2. XAMPP o Laragon
3. Composer instalado
4. MySQL

## Pasos de instalación
1. Instalar dependencias con Composer:
    ```bash
    composer install
    ```
2. Configurar las variables de entorno:
    - Copiar `.env.example` a `.env`
    - Configurar las siguientes variables:
        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=backend
        DB_USERNAME=root
        DB_PASSWORD=

        JWT_SECRET=Tjfq5oKFN9NfoWCxkedD9ssWT7H7Ew9yzBAlLBBsGifaUUONbxU79wE3ORdARiEE
        ```
3. Generar la key de Laravel:
    ```bash
    php artisan key:generate
    ```
4. Migrar la base de datos:
    ```bash
    php artisan migrate
    ```
5. Cargar datos iniciales (Seeders):
    ```bash
    php artisan db:seed
    ```

## Cómo ejecutar el proyecto
1. Iniciar el servidor de Laravel en el puerto 8001:
    ```bash
    php artisan serve --port=8001
    ```
2. Acceder a la aplicación en el navegador:
    ```
    http://127.0.0.1:8001
    ```

## Notas
- Asegúrate de que tu servidor de MySQL esté activo.
- Si modificas `.env`, recuerda reiniciar el servidor de Laravel.
- JWT_SECRET es necesario para la autenticación con tokens.
