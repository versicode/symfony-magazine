Symfony magazine 
========

Posts with tags and posts with authors.

## How to use it?
- Clone repo.

- Execute few bash commands:
```bash
composer install
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
php app/console doctrine:fixtures:load
php app/console server:run
```

