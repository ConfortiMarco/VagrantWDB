#!/bin/bash

apt-get update -y
apt-get upgrade -y

apt-get install -y mysql-server

sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf # https://stackoverflow.com/questions/45900235/change-mysql-bind-address-from-command-line-in-vagrant

mysql -e "CREATE USER 'webadmin'@'%' IDENTIFIED BY 'Admin$00' ;"
mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'webadmin'@'%' WITH GRANT OPTION;"
mysql -e "FLUSH PRIVILEGES;"
mysql -e "CREATE DATABASE marco_conforti;"

mysql -u webadmin -pAdmin$00 marco_conforti < /home/vagrant/.scripts/mydb.sql # All'interno di questo file viene creato l'utente per l'accesso al database
mysql -u webadmin -pAdmin$00 marco_conforti < /home/vagrant/.scripts/data_finale.sql

sudo systemctl restart mysql