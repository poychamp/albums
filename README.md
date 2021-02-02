# albums (albums)

App built with Quasar in the frontend and Laravel in the backend 

## Frontend
* Go to /
* `npm install`
* Edit `baseUrl` in `src/boot/axios.js` if needed

## Backend
* Go to /app
* `composer install`
* Copy `.env.example` to `.env`
* `php artisan key:generate`
* Edit `.env` and configure the `DB_` values
* `php artisan migrate:fresh --seed`
