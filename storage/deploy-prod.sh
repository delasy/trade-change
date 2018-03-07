#!/bin/sh

cd /var/www/trade-change;
sudo git pull origin dev;
sudo git push origin master;
sudo php artisan migrate --force;
