# Vagrant doppia macchina

## Macchina Web
- 2 CPU
- 2 RAM
- Cartella condivisa per il sito web
- Installazione:
    - php 
    - apache2
    - composer
- Configurazioni:
    - composer, installazione moduli necessari per il funzionamento dell'applicativo
    - apache, AllowOverride impostato ad All per far funzionare il file .htaccess
    - abilitazione modulo mod_rewrite per funzionamento di del file .htaccess
- Applicativo

## Macchina Db
- 2 CPU
- 2 RAM
- Cartella condivisa per gli script di mysql
- Installazione:
    - mysql server
- Configurazioni:
    - Modifica del file di configurazione per l'accesso da mysql dalla macchina web
    - Aggiunta del database e aggiunta di tabella e dati e utente al suo interno.

Alla fine della configurazione sarà possibile vedere il sito all'indirizzo http://192.168.56.10

Dopodiché si potrà testare facendo il login:
- email: alessandro.rossi@example.com
- password: Admin$00