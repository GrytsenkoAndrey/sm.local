# Local deploy

## Requirements
You have installed
* PHP >= 7.4
* MySQL >= 5.7 | MariaDB >= 10.2
* Node.js >= 12

## Deploy
* unzip to some local directory *.zip, e.g. sm.local
* `cd sm.local`
* make copy of **.env.example** to **.env**
* set DataBase parameters (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
* run in the terminal `composer install`
* run in the terminal `php artisan key:generate`
* run in the terminal `php artisan migrate --seed`
* run in the terminal `npm install && npm run dev` (in case of error run `npm run dev` one more time)
* run in the terminal `php artisan serve`
* open your browser and visit [localhost](http://localhost)
