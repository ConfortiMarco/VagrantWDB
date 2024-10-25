#!/bin/bash

apt-get update -y
apt-get upgrade -y

apt-get install -y apache2
apt-get install -y php libapache2-mod-php php-mysql php-curl php-xml

curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

sudo a2enmod rewrite # Serve per far funzionare file .htaccess nel progetto

sudo sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

composer install --working-dir=/var/www/html
composer dumpautoload --working-dir=/var/www/html

sudo systemctl restart apache2