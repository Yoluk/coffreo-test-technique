# Coffreo technical test

## Installation

The recommended way to install this project is to clone it :

```bash
$ git clone https://github.com/Yoluk/coffreo-test-technique.git my_folder
$ cd my_folder
```

Then, you should set up the database in a MySQL evironnement.

You can find the sql dump under `/src/MarketplaceBundle/Resources/config/marketplace.sql`.

(On a classic phpMyAdmin, you can import the file, or copy-paste its content.)

Once the database is ready, you can run composer to install the project dependencies :
```bash
$ composer install
```

You will be asked to provide informations for database configuration :
```yaml
database_host (127.0.0.1): 
database_port (null): 
database_name (symfony): marketplace
database_user (root): your_database_user
database_password (null): your_database_password
```

Finally, you can run the projet with the built-in Symfony web server :
```bash
$ app/console serv:start --env="prod"
```

## Unit Tests

Unit tests have been written for the back-end. Run them using PHPUnit:
```bash
$ phpunit -c app
```