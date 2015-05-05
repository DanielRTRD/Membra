@ECHO OFF
php artisan migrate:reset
php artisan migrate
php artisan db:seed
pause