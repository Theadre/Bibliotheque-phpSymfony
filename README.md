# tp2
* create data base with use of info in env file
php bin/console doctrine:database:create 
* create user
php bin/console make:user 
* update user
php bin/console make:entity
*
php bin/console make:migration 
php bin/console doctrine:migrations:migrate
* auth LoginFormAuthenticator  SecurityController 
php bin/console make:auth

php bin/console server:run 

php bin/console make:registration-form
# tp3

php bin/console make:entity
php bin/console make:migration
php bin/console doctrine:migrations:migrate
# tp4
php bin/console make:crud Category
php bin/console make:crud Livre

``` bash
# dsdsd
composer create-project symfony/website-skeleton mon-super-projet
cd mon-super-projet
php bin/console server:run
php bin/console make:entity
or
php bin/console make:entity --regenerate with setter and getter
php bin/console make:migration
php bin/console doctrine:migrations:migrate

php bin/console make:controller UserController
php bin/console make:repository User

```

# dddd

> scscsc
[Traversy Media](http://www.traversymedia.com)