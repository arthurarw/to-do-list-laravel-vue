## About the Project

This project was created with the intention of learning.
The project consists of a To-Do system, where you create, update and delete your To-Do and insert Tasks inside the To-Do.

## Technologies

- [VueJS](https://vuejs.org/v2/guide/)
- [Laravel 8](http://laravel.com/)

## Prerequisites

1. Install [Yarn](https://yarnpkg.com/);
2. Install [Composer](http://getcomposer.org/);
3. PHP >= 7.3
4. Node v14.16

## Setup

1. Open the frontend folder on your console and type `yarn install`, after that, wait for the installation;
2. Open the backend folder on your console and type `composer install`, after that, wait for the installation;
3. After composer installation, in backend folder on your console type: `php artisan jwt:secret`, after that, `php artisan key:generate`;
4. Rename the `.env.example` to `.env` and configure your database;
5. After configuring your database, type this in the console inside the backend folder: `php artisan migrate` after this command, type this: `php artisan db:seed`. This will make you populate your database with fictitious information.

After all the steps above, on your console in the frontend folder type: `npm run dev`
And in the backend folder on the console type: `php artisan serve`

## Using

Open in your browser `http://localhost:8080/`.

Login with this credentials:

> E-mail: admin@mail.com
> Password: password

And enjoy it!

##### My thanks to [Tiago Matos](https://www.instagram.com/tiagomatosweb/) for giving this course so well.

##### Link to the course: [click here](https://pro.tiagomatos.com/laravel-api-vuejs-spa/).
