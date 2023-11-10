#!/bin/bash

echo "Install application"
cd /var/www/app && docker-compose up -d
cp /var/www/.env /var/www/app/.env
docker exec budgetcontrol-services bash -c "composer install"
docker exec budgetcontrol-services bash -c "php artisan config:cache"
docker exec budgetcontrol-services bash -c "php artisan migrate"
docker exec budgetcontrol-services bash -c "cd /var/www/workdir && chown -R www-data:www-data *" #apache group
docker exec budgetcontrol-services bash -c "cd /var/www/workdir && chmod 775 -R *" #apache group
docker exec budgetcontrol-services bash -c "service apache2 restart"