# Instalação e configuração


### Installation

Start a new Laravel project:
```php
composer create-project laravel/laravel your-project-name
```

Then run the following to add FormMaker
```php
composer require "sierratecnologia/facilitador"
```

Time to publish those assets!
```php
php artisan vendor:publish --provider="Facilitador\FacilitadorProvider"
```
