# laPasticceria
la Pasticceria è un'applicazione che implementa le seguenti istruzioni:
> La pasticceria vende dolci che hanno un nome ed un prezzo. Ogni dolce è composto da una lista di ingredienti. Opzionale: indicare di ogni ingrediente quantità e unità di misura.
Opzionale: La gestione della pasticceria è in mano a Luana e Maria che vogliono avere il proprio account per poter accedere all'area di backoffice tramite email e password.
Nell’area di backoffice si possono gestire (CRUD) i dolci e metterli in vendita con una certa disponibilità (esempio: 3 torte paradiso in vendita). I dolci in vendita invecchiano ed in base al tempo trascorso dalla loro messa in vendita hanno prezzi diversi: primo giorno prezzo pieno, secondo giorno costano l’80%, il terzo giorno il 20%. Il quarto giorno non sono commestibili e devono essere ritirati dalla vendita.
Realizzare una pagina vetrina dove tutti possono vedere la lista di dolci disponibili e il
prezzo relativo.
Opzionale: andando nella pagina del dettaglio del dolce (o tramite overlayer), si scoprono
gli ingredienti indicati dalla ricetta.


## Requisiti minimi
laPasticceria è basato sul framework Php **Laravel**. 

Composer 1.10.7  
PHP 7.2.5  
MySQL 10.4.11  
Node.js 13.12.0  


## Uso
Installa dapprima i moduli necessari:

```
composer install
```

```
npm install
```

Crea il file .env, seguendo l'esempio fornito da .env.example (si trova nella cartella root). Di particolare importanza i seguenti parametri:

```
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Lancia i seguenti comandi:
```
php artisan key:generate 
 ```

```
php artisan serve
 ```

```
npm run watch
 ```


Esegui le migrazioni e il seeding:

 ```
php artisan migrate:fresh --seed
 ```

Puoi eseguire quest'ultimo comando più volte; è importante però che le immagini salvate in storage\public\imagesSeeding siano le stesse che si trovano in  imagesSeeding (cartella nella root del progetto). In caso contrario, puoi copiare le foto dall'ultima cartella e incollarle nelle prime.

Il seeding crea due utenti: Maria and Laura. Puoi accedere a entrambe le aree private usando come username: maria@mail.com o laura@mail.com, e 'prova' (senza virgolette) come password.

Infine, facendo accesso all'area privata, nella home dell'area privata (url: /user) potrai consultare ulteriori istruzioni di navigazione.


## Caratteristiche
L'applicazione ha un'unica homepage che può essere visitata da utenti registrati e non registrati.

L'homepage è stata costruita principalmente usando il framework JavaScript **Vue.js**.

Al caricamento della pagina, i dati sono reperiti con una chiamata Ajax attraverso un API pubblica all'url: api/cake_type.

Nell'homepage, sono mostrate le varie tipologie di dolci con il proprio prezzo e quantità. Per ogni tipologia di dolce è mostrato il prezzo più basso (cioè della singola torta più vecchia). Le torte scadute (più vecchie di tre giorni) non sono invece computate.

L'utente autenticato, può, facendo accesso all'area privata, vedere per ogni tipo di torta la quantità totale in vendita, la quantità creata nelle ultime 24, 48 e 72 ore con il relativo prezzo.
Gli utenti autenticati possono inoltre effettuare le classiche operazioni CRUD facendo accesso all'area privata. 

Non è prevista la registrazione di nuovi utenti.

### CRUD ###
L'applicazione permette di eseguire operazioni CRUD per le seguenti risorse:
- **ingredients** (ingredienti),
- **cake_types** (ricette), e
- **cakes** (dolci).

Ciascuna risora ha una sua tabella nel database col proprio nome.
Fra ingredienti e ricette vi è una relazione Many-to-Many (tabella pivot: **cake_types_ingredients**)
Fra ricette e torte vi è una relazione One-to-Many.

Per gli ingredienti e per le torte non è previsto l'operazione **update**. 
Un ingrediente non può essere eliminato finché non sono state eliminate tutte le ricette che ne fanno uso, mentre non è possibile creare o modificare una ricetta in modo che non abbia almeno un ingrediente. 
L'eliminazione di una ricetta comporta l'eliminazione di tutte le torte relative.

###
Usa:
 ```
php artisan route:list
 ```


per ottenere la lista di tutte le rotte, con i controller di riferimento e il tipo di richiesta eseguito. 

I model sono salvati nella cartella app.

I controller si trovano in app\Http\Controllers. I controller dentro la cartella User gestiscono le rotte che richiedono l'autenticazione dell'utente.

Per le migrazioni e i seeding, consultare la cartella database.

## Anteprima ##
 ![homepage](readme_gif/gif1.gif)
