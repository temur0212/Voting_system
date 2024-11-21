<p align="center">
    <h1 align="center">Voting_system </h1>
</p>


## Installation

### Requirements

For system requirements you [Check Laravel Requirement](https://laravel.com/docs/10.x/deployment#server-requirements)

### Clone the repository from github.

    git clone https://github.com/temur0212/Voting_system.git [YourDirectoryName]

The command installs the project in a directory named `YourDirectoryName`. You can choose a different
directory name if you want.

### Install dependencies

Laravel utilizes [Composer](https://getcomposer.org/) to manage its dependencies. So, before using Laravel, make sure you have Composer installed on your machine.

    cd YourDirectoryName
    composer install

### Config file

 `cp .env.example .env`   create the `.env`  file using the command below
`php artisan key:generate`  to generate app key.

 Set your database credentials in your `.env` file
    `DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password`



### Database

1. Migrate database table `php artisan migrate`

### Install Node Dependencies

1. `npm install` to install node dependencies
1. `npm run dev` for development or `npm run build` for production



### Run Server

1. `php artisan serve` or Laravel Homestead
1. Visit `localhost:8000` in your browser.


### Screenshots

