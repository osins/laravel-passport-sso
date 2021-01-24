# laravel-passport-sso
This is Single Sign-On for Laravel 7.30

your local host config:
```
127.0.0.1 sso consumer
```

url:
```
http://consumer:8081/sso/passport
http://sso:8080/login
```

sso init:
[Installation & Basic Usage](https://laravel.com/docs/7.x/passport)

bash:
```
composer create-project --prefer-dist laravel/laravel:^7.0 sso
cd sso
composer require laravel/ui:^2.0
php artisan ui bootstrap --auth
composer require laravel/passport:^9.0
sed -i 's/use Notifiable;/use \Laravel\\Passport\\HasApiTokens, Notifiable;/g' app/User.php
sed -i "s/\/\/ 'App\\\\Model'/'App\\\\Model'/g" app/Providers/AuthServiceProvider.php
sed -i "s/\/\//\\\\Laravel\\\\Passport\\\\Passport::routes\(\);/g" app/Providers/AuthServiceProvider.php
sed -i "s/'driver' => 'token',/'driver' => 'passport',/g" config/auth.php
# php artisan migrate
# php artisan passport:install
# php artisan passport:keys 
```

consumer init:
[Installation & Basic Usage](https://socialiteproviders.com/Laravel-Passport/#installation-basic-usage)
