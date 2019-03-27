# Test beer application
* Symfony
* Messanger component
* Prooph Event sourcing
* Prooph Event store
    
    
## Installation

Create your database   

Run SQL in your DB
```
* vendor/prooph/pdo-event-store/scripts/mysql/01_event_streams_table.sql
* vendor/prooph/pdo-event-store/scripts/mysql/02_projections_table.sql
```


#### Run the symfony command to create the event stream
Need only for writing by Aggregate Type. For Aggregate creates stream automatically.
```
php bin/console prooph_event_store.todo_store
```

#### To test saving GET REQUEST 
```
127.0.0.1/test
```
Or
```
127.0.0.1/supplier/{id}
```

#### Fixtures
```php
php bin/console doctrine:fixtures:load;
```