# Construire une application de réservation de logement
Le projet consiste à développer une application de réservation de logement inspiré d’Airbnb, 
 
## Les contraintes techniques 
Utiliser Symfony avec le template Twig pour le front et une base de données Mysql.

## Instalation

### Back

````
composer i

````
Configurer le schema qui se trouve dans le fichier .env
````
php bin/console doctrine:database:create

php bin/console make:migration
 
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


