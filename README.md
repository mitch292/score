# score
a simple application to complement your memories of sporting events.

## tech stack
* Laravel
* MYSQL
* Vue.js

## running a dev environment
there are a couple tools that'll help you run a simple dev environment
* [docker](https://www.docker.com/)
* [laravel valet](https://laravel.com/docs/6.x/valet)
* [composer](https://getcomposer.org/)
* [npm](https://www.npmjs.com/)

once you have these tools available follow these steps to get up and running
1. database
* running your development db on docker lets you run multiple databases at once simply on your machine and helps keep our db environment uniform
* pull a mysql 5.7 image from docker `docker pull mysql:5.7`
* run a docker image with our database `docker run --name score -e MYSQL_ROOT_PASSWORD={your_pw} -p 3307:3306 -d mysql:5.7`
* use the command line or a SQL client to connect to the db, `mysql -u root -h 127.0.0.1 --port=3307 -p`
* create a score database `CREATE DATABASE score;`

2. laravel valet 
* We need a valid top level domain for OAuth in the dev, so we change the default valet domain
* Run `valet tld abc` to change the top level domain to `.abc`

3. application
* clone the repo
* run `composer install`
* run `npm install`
* link the site with laravel valet `valet link score`
* run `npm run watch`
* run the db migration `php artisan migrate`
* run the db seeders `php artisan db:seed`

now your good to go. navigate to `http://score.abc`.  happy coding!

