#!/bin/bash

php artisan migrate:fresh --seed
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear