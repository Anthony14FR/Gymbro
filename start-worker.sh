#!/bin/bash

# Nettoyer le cache
php artisan cache:clear

# Démarrer le worker
php artisan queue:work