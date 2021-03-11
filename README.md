# laPasticceria
laPasticceria (en: "ThePastry") is an application that implements the following instructions:

> (en) The pastry shop sells sweets that have a name and a price. Each dessert consists of a list of ingredients. Optional: indicate the quantity and unit of measurement of each ingredient.
Optional: The management of the pastry shop is in the hands of Luana and Maria who want to have their own account in order to access the back office area via email and password.
In the back office area you can manage (CRUD) the cakes and put them on sale with a certain availability (example: 3 heaven cakes for sale). The sweets for sale age and, based on the time that has elapsed since they were put on sale, have different prices: the first day full price, the second day cost 80%, the third day 20%. On the fourth day they are not edible and must be withdrawn from sale.
Create a showcase page where everyone can see the list of caked available and their price.
Optional: by going to the detail page of the cake (or via the overlayer), they discover show the ingredients indicated by the recipe.

> (it) La pasticceria vende dolci che hanno un nome ed un prezzo. Ogni dolce è composto da una lista di ingredienti. Opzionale: indicare di ogni ingrediente quantità e unità di misura.
Opzionale: La gestione della pasticceria è in mano a Luana e Maria che vogliono avere il proprio account per poter accedere all'area di backoffice tramite email e password.
Nell’area di backoffice si possono gestire (CRUD) i dolci e metterli in vendita con una certa disponibilità (esempio: 3 torte paradiso in vendita). I dolci in vendita invecchiano ed in base al tempo trascorso dalla loro messa in vendita hanno prezzi diversi: primo giorno prezzo pieno, secondo giorno costano l’80%, il terzo giorno il 20%. Il quarto giorno non sono commestibili e devono essere ritirati dalla vendita.
Realizzare una pagina vetrina dove tutti possono vedere la lista di dolci disponibili e il
prezzo relativo.
Opzionale: andando nella pagina del dettaglio del dolce (o tramite overlayer), si scoprono
gli ingredienti indicati dalla ricetta.


## Preview ##
 ![homepage](readme_gif/gif1.gif)


## Minimum requirements
laPasticceria is based on the Php **Laravel** framework.

Composer 1.10.7  
PHP 7.2.5  
MySQL 10.4.11  
Node.js 13.12.0  


## Use
Install the required dependencies:

```
composer install
```

```
npm install
```

Create an .env file, following the example provided by .env.example (in the root folder). The following parameters are most important:

```
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

The run:
```
php artisan key:generate 
 ```

```
php artisan serve
 ```

```
npm run watch
 ```


Run migrations and seeding:

 ```
php artisan migrate:fresh --seed
 ```

You can run the last command multiple times; however, it is important that the images saved in storage /public/imagesSeeding are the same as those found in imagesSeeding (folder in the root of the project). If they are not, copy the photos from the last folder and paste them into the first ones.

The seeding creates two users: Maria and Laura. You can access both private areas using as username: maria@mail.com or laura@mail.com, and 'test' (without quotes) as password.

Finally, by accessing the private area, in the homepage (url: / user) you may consult further instructions.


## Features
The application consist of a single homepage that can be visited by registered and unregistered users.

The homepage is mainly built using ** Vue.js ** JavaScript framework.

On page load, data is retrieved from a public API at the url: api / cake_type.

On the homepage, the various types of cakes are shown with their price and quantity. For each type of cake the lowest price is shown (i.e. the single oldest cake). The expired cakes (older than three days) are not counted.

The authenticated user can, by accessing the private area, see for each type of cake the total quantity on sale, the quantity created in the last 24, 48 and 72 hours with the relative price.
Authenticated users can also perform the classic CRUD operations by accessing the private area.

New users registration is not allowed.


### CRUD ###
The application allows you to perform CRUD operations for the following entities:
- **ingredients**,
- **cake_types**, e
- **cakes**.

Each entity has its own table in the database with its own name.
A Many-to-Many relationship exists between ingredients and recipes (pivot table: **cake_types_ingredients**)
A one-to-many relationship exists between recipes and cakes.

The **update** operation is not allowed for ingredients and cakes.
An ingredient cannot be deleted until all recipes that use it have been deleted; it is also not possible to create or modify a recipe in such a way that it does not have at least one ingredient.
Deleting a recipe deletes all related cakes.

###
Run:
 ```
php artisan route:list
 ```


to get the list of all the routes, with the related controllers and the http method.

The models are saved in the app folder.

The controllers are located in app /Http/Controllers. The controllers inside the User folder manage all routes requiring user authentication.

For migrations and seeding, consult the database folder.
