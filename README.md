# Test beer application
* Symfony
* CQRS
* Prooph Event sourcing
* Prooph Event store
    
    
## Installation

Create your database   

Run SQL in your DB
```
* vendor/prooph/pdo-event-store/scripts/mysql/01_event_streams_table.sql
* vendor/prooph/pdo-event-store/scripts/mysql/02_projections_table.sql
```


Run the symfony command
```
php bin/console prooph_event_store.todo_store
```