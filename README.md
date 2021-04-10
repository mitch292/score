# score

a simple application to complement your memories of sporting events.

## tech stack

-   Laravel
-   MySQL
-   Vue.js

## running a dev environment

there are a couple tools that'll help you run a simple dev environment

-   [docker](https://www.docker.com/)
-   [laravel sail](https://laravel.com/docs/8.x/sail)
-   [composer](https://getcomposer.org/)
-   [npm](https://www.npmjs.com/)

once you have these tools available follow these steps to get up and running

## server setup

-   run `./vendor/bin/sail up` or `sail up` if you have a sail alias.
-   run `./vendor/bin/sail artisan migrate:fresh --seed`

## frontend

-   run `npm install`
-   run `npm run watch`

### social login

-   in order for social login to work, we need a vanity url - `sudo vim /etc/hosts/` - Add to your localhost or 127.0.0.1 line, `http://score.abc`

now your good to go. navigate to `http://score.abc`. happy coding!
