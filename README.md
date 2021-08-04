# Construire une application de réservation de logement
Le projet consiste à développer une application de réservation de logement inspiré d’Airbnb, 
Les contraintes techniques sont d'utiliser Symfony avec le template Twig pour le front et une base de données Mysql.

## Instalation

### Back

````
composer i

````
#### Database  
````
php bin/console doctrine:database:create

php bin/console make:migration
 
php bin/console doctrine:migrations:migrate

symfony server:start
````
### Front
````
npm i
npm run w
````


