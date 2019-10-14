# ONECOMET

### Project

##### Pre-requisites:

- NodeJs >= v10.15.3
- [Composer](https://getcomposer.org)
- PHP >= 7.2
- MySQL or MariaDB
    
##### Installation:

1. Clone repository:
    ```bash 
    git clone https://github.com/creativechain/onecomet.git
    ```
2. Create the project DB:
    - Execute MySQL prompt. Use the superuser password if is needed:
    ```bash
    mysql -u root -p
    ```
        
    - Create a new DB:
    ```mysql
    CREATE DATABASE onecomet;
    ```
        
    - Create a new user to manage the DB. `dbuser` will be the username to access the DB, and `password` will be her
    password to access. 
    ```mysql
    GRANT ALL PRIVILEGES ON onecomet.* TO 'ocuser'@'localhost' IDENTIFIED BY 'password';
    ```
        
    - Copy `.env.example` file as new `.env` file and edit it. Replace this environment variable value in this file
    for values used in the last step:
    ```dotenv
    DB_PASSWORD=password
    ```
3. Install dependencies:
    ```bash
    cd onecomet
    composer install
    npm install
  
    php artisan key:generate
    php artisan migrate
    ```

##### Compile assets:
The project provides several tools to efficiently compile and minify js and css files. Source files must be created and 
modified within their respective directory in `resources`. For example, for SASS files, this must be created within 
`resources/sass`. 

For one time files compilation execute this command:
- In development mode:
```bash
npm run dev
```
- In production mode:
```bash
npm run prod
```

For live compilation (automatically compilation when file is changed and saved) execute this command:
- In development mode:
```bash
npm run watch
```

#### Run project locally
To run project locally execute:
```bash
php artisan serve
```

Go to [localhost:8000](http://localhost:8000)

If you want to change the port execute:
```bash
php artisan serve --port port_number
```

For example:
```bash
php artisan serve --port 9000
```

Go to [localhost:9000](http://localhost:9000)