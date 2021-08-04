# Construire une application de réservation de logement
Le projet consiste à développer une application de réservation de logement inspiré d’Airbnb, 
 
## Les contraintes techniques 
Utiliser Symfony avec le template Twig pour le front et une base de données Mysql.

## Instalation

### Back

````
composer install

````
Configurer le fichier .env
````
php bin/console doctrine:database:create
 
php bin/console doctrine:migrations:migrate

````
````
symfony server:start
````
### Front
````
npm i
npm run w
````


