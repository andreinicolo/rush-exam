### Clone the repository
    > git clone https://git@github.com:andreinicolo/rush-exam.git


### Install the dependencies
    > composer install


### setup the .env file and put the database credentials
    > cp .env.example .env
    > php artisan key:generate
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=[your database name here]
        DB_USERNAME=[your db username]
        DB_PASSWORD=[your db password]

### migrate and seed
    > php artisan migrate
    > php artisan db:seed


### install passport
    > php artisan passport:install

### run the project locally
    > php artisan serve


- go to http://localhost:8000/ to test the project
- use the following credentials to login:
    > username: admin@admin.com
    
    > password: admin
