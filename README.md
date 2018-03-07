# trade-change.com

## Installation

### Project installation

```bash
cd /path/to/project/;
sudo cp .env.example .env;
sudo composer install;
sudo composer dump-autoload;
sudo php artisan key:generate;
sudo php artisan migrate --seed;
```

### Permissions

```
sudo chgrp -R www-data storage bootstrap/cache;
sudo chmod -R ug+rwx storage bootstrap/cache;
```
>If you are using MacOS use `sudo chgrp -R _www storage bootstrap/cache;` instead.

Use `sudo composer magic-update` for update.

### Test database

```bash
sudo composer dump-autoload;
sudo php artisan db:seed --class=TestData;
```
