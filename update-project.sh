#!/usr/bin/env bash

git reset --hard
git pull
composer update
npm install
php artisan migrate
php artisan cache:clear
npm run dev