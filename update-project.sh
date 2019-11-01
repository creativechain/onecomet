#!/usr/bin/env bash

git pull
composer update
npm install
php artisan migrate
php artisan cache:clear