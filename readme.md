# modus-nhtsa-api
Modus PHP Backend API using [Laravel](https://laravel.com/)

This is a short coding assignment, which
implement an API in PHP [Laravel](https://laravel.com/) that calls a "backend API" to get information
about crash test ratings for vehicles.

The underlying API that is to be used here is the [NHTSA NCAP 5 Star Safety Ratings API](https://one.nhtsa.gov/webapi/Default.aspx?SafetyRatings/API/5)


 ## Requirements
 * PHP     : 7.2.15
 * Laravel : 5.8.*
 * Composer 
 
 ## Installation
 
 ```
 # Clone git repository
 $ git clone git@github.com:hassanjamal/modus-nhtsa-api.git
 
 # Change working directory
 $ cd modus-nhtsa-api
 
 # Create ENV file and generate key
 $ cp .env.example .env && php artisan key:generate
 
 # Install Composer dependencies
 $ composer install
 ```
 
 #### Run development server
 ```
 $ php artisan serve --port=8080
 ```
 #### Run tests
 ```
 $ ./vendor/bin/phpunit
 ```
 
 ## Assignment Details
 * Requirement 1 [Github Issue Link](https://github.com/hassanjamal/modus-nhtsa-api/issues/1)
 ```
 GET http://localhost:8080/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>
```
 * Requirement 2 [Github Issue Link](https://github.com/hassanjamal/modus-nhtsa-api/issues/3)
 ``` 
 POST http://localhost:8080/vehicles
 ```
 * Requirement 3 [Github Issue Link](https://github.com/hassanjamal/modus-nhtsa-api/issues/5)
 ``` 
 GET http://localhost:8080/vehicles/<MODEL>/<YEAR>/<MANUFACTURER>/<MODEL>?withRating=true
 ```
 
 ## TroubleShoot
 ```
$ php artisan config:clear && php artisan clear-compiled && php artisan cache:clear
```
 
 