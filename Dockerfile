# Utiliser l'image Laravel Sail comme base
FROM laravelsail/php83-composer:latest

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

# Copier les fichiers composer et installer les dépendances
COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs --no-scripts --no-autoloader

# Copier tous les fichiers du projet
COPY . .

# Générer l'autoloader de Composer
RUN composer dump-autoload

# Rendre le script start-worker.sh exécutable
RUN chmod +x start-worker.sh
