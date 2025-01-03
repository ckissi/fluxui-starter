## About FluxUI starter

This is a Laravel 11 starter project with the following components

- FluxUI PRO
- Livewire Volt
- Laravel Folio
- honeystone/laravel-seo
- spatie/laravel-login-link

## Instalation

1. Install composer dependencies

```
composer install
```
2. Install npm dependencies
```
npm install
```
3. Activate FluxUI
```
php artisan flux:activate
```
4. Install Laravel Volt
```
php artisan volt:install
```
5. Install Laravel Folio
```
php artisan folio:install
```

## Social/Email logins
In order to enable login by email and password add this to your env file:
```
EMAIL_LOGIN_ENABLED=true
```


In order to use social logins you have to enable them in the .env file
```
GITHUB_LOGIN=true
GOOGLE_LOGIN=true
```

You have to include social login credentials like this (change the URL appropriately):
```
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback


GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT_URL=http://localhost:8000/auth/github/callback
```

Please check web.php route file for actual social login routes



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
