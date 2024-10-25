#!/bin/bash

apt-get update -y
apt-get upgrade -y

apt-get install -y apache2
apt-get install -y php libapache2-mod-php php-mysql

sudo a2enmod rewrite # Serve per far funzionare file .htaccess nel progetto

sudo sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

sudo systemctl restart apache2