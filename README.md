# RoyalTrading
# 
* Frontend 
  - HTML5
  - Bootstrap 4.0
  
* Framework
  - Laravel 5.8
  - Mysql  
  
* Install
  - Clone Repository ```git clone https://github.com/sanjayvekariya18/RoyalTrading.git```
  - Edit Database config in /.evn file
  
    DB_HOST=<127.0.0.1>
    
    DB_PORT=<3306>
    
    DB_DATABASE=royal_trading
    
    DB_USERNAME=<db_user>
    
    DB_PASSWORD=<db_password>
        
  - Clear config cache: ```php artisan config:cache```
  - Running Migrations Database: ```php artisan migrate:fresh``` (create schema in database)
  - Running Database Seeder: ```php artisan db:seed``` (Insert default 20 records in schema)
  
  ----  

#### GET

`All Product` : http://royaltrading.codexivesolutions.com/api/products


`Search Product` : http://royaltrading.codexivesolutions.com/api/products/{id}

#### POST

`Insert` : http://royaltrading.codexivesolutions.com/api/products

`PARAMETERS`

| Field   | Data  | 
| :------------: |:---------------:| 
| name       | sanjay | 
| price      | 10    |  
| description| I am web developer |  
  
#### PUT

`Edit` : http://localhost:8000/api/products/{id}
  
#### DELETE

`Delete` : http://localhost:8000/api/products/{id}
