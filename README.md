# laPasticceria
la Pasticceria implements the following:
> La pasticceria vende dolci che hanno un nome ed un prezzo. Ogni dolce è composto da una lista di ingredienti. Opzionale: indicare di ogni ingrediente quantità e unità di misura.
Opzionale: La gestione della pasticceria è in mano a Luana e Maria che vogliono avere il proprio account per poter accedere all'area di backoffice tramite email e password.
Nell’area di backoffice si possono gestire (CRUD) i dolci e metterli in vendita con una certa disponibilità (esempio: 3 torte paradiso in vendita). I dolci in vendita invecchiano ed in base al tempo trascorso dalla loro messa in vendita hanno prezzi diversi: primo giorno prezzo pieno, secondo giorno costano l’80%, il terzo giorno il 20%. Il quarto giorno non sono commestibili e devono essere ritirati dalla vendita.
Realizzare una pagina vetrina dove tutti possono vedere la lista di dolci disponibili e il
prezzo relativo.
Opzionale: andando nella pagina del dettaglio del dolce (o tramite overlayer), si scoprono
gli ingredienti indicati dalla ricetta.


## Minimum Requirements
laPasticceria is based on the Laravel Php Framework.

Composer 1.10.7
PHP 7.2.5
MySQL 10.4.11 
Node.js 13.12.0


## Usage
Install all modules:

```
composer install
```

```
npm install
```

Create a .env file, following the the .env.example file in the root directory. In particular set the following for database connection.

```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
Then run:
```
php artisan key:generate 
 ```

```
php artisan serve
 ```

```
npm run watch
 ```

Then run migrations and seeding:

 ```
php artisan migrate:fresh --seed
 ```

Run again the last command whenever necessary. However do check that the folder \storage\public\imagesSeeding contains all the images which are also present in \imagesSeeding folder (in the root folder): if necessary you can copy/paste the latter in \storage\public.

The seeding will create two user: Maria and Laura. You can access their account using: maria@mail.com or laura@mail.com, and using 'prova' (no quotes) as password.


## Features
The application has a unique homepage, mostly built with the Vue.js libary. 
A public Api (url: api/cake_type) is used to fetch the data.

Authenticated user can access their personal accounts and perform CRUD operations. Registration of new users is not possible.

