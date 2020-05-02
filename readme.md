## Prerequisites

- [XAMPP v7.3.10](https://xampp.site/) (or just ensure that [PHP v7.3.10>](https://www.php.net/) and [MariaDB v10.4.8>](https://mariadb.org/) is installed)
- [Composer v1.9.0>](https://getcomposer.org/) (PHP Dependency Manager)
- [NodeJS v13.7.0>](https://nodejs.org/)

## Setup

#### Step 1: Installing Dependencies
Run `composer install` and `npm install`, `npm audit fix`.
#### Step 2: Environment Variables
Ensure that in the root of the project folder, a *.env* file is created. Rename the *.env.example* file to *.env* and change the *DB_* segment accordingly to your database setup.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=username
DB_PASSWORD=password
```
#### Step 3: Project Setup
To link server storage, run `php artisan storage:link`. This will create a symbolic link *storage* in *public*. 
To generate passport key, run `php artisan passport:keys`, then `php artisan key:generate`.
To setup schema to your database, run `php artisan migrate` or `php artisan migrate --seed`. 

#### Step 4: Data Seeding (Optional)
Once migration is done, you can fill it with generated dataset using `php artisan db:seed`. (this is done automatically if you run `php artisan migrate --seed` instead of `php artisan migrate`)
Dataset consists of:
- 1 tutor account
- 30 student accounts
- 4 topics under the tutor account
- 10 questions for each topics, with a total of 40 questions
- 4 answers for each question
- 1 password grant (for use with the game client)

All generated user accounts' password are 'password'.

Note that sprite assets for each topic are not generated from seeding. Manually include the following files into '' 

#### Step 4.5: Password Grant
If you skipped data seeding, you will still need to have a password grant entry in your database for use with your game client later. To generate one, run `php artisan passport:client --password`.

#### Step 5: 
Build frontend using `npm run dev` or `npm run prod`.
To start serving, run `php artisan serve`.  

## Laravel Documentation
For an in-depth documentation on Laravel, visit Laravel Documentation page at https://laravel.com/docs/7.x.
