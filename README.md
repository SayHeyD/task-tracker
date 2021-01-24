# Task-Tracker

![Laravel](https://github.com/SayHeyD/task-tracker/workflows/Laravel/badge.svg)

Task-Tracker is a Web-App to track your short term tasks you don't want in your calendar.

It is currently in development and maintained as a side project.

## Requirements

Php: ```7.4```

Laravel: ```8.0```

Composer: ```2.0.5```

Node: ```14.15.2```

Npm: ```6.14.11```

## Deployment

[Laravel deployment page](https://laravel.com/docs/8.x/deployment)

The web-root must be set to the ```public/``` folder.

Generate .env file from template: ```cp .env.example .env```

Then fill out all values in the .env file. Don't forget to set ```APP_ENV``` to ```production```

Download composer packages: ```composer install```

Generate application key: ```php artisan key:generate```

Run database migrations: ```php artisan migrate```

Download node packages: ```npm install```

Build frontend: ```npm run prod```

