# PHP - Back End - PHP

## Commands

Install Composer

`composer install`

Now you will have into the `BASE_PATH` a copy of `.env` file, update it with your credentials of an empty database, then run: 

`composer db-migrate-seeds`

Great, now you have ready the database, you can run the application with `PHP` server:

`composer start-server`

By default it srtart on `http://localhost:8080`

## Aplication

With the app running, the first step is register with a dummy user.
You can login and go to `/search` to get the main data, first you need to `Get Data` then will be able to make inquiries into the aplication.