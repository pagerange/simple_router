# Simple Router

After building a simple MVC as a class exercise, with a rudimentary router, wanted to experiment with a regular expression based router for use in class.  Not for production.  This is just for play.

## Requirements

* Routes defined in the usual way
 
```php

use \App\SimpleRouter as Route;

   Route::get('cars/{make}/{model}/{year}', function($make, $model, $year){
        // do something
    });

 ```

* Must handle RESTful methods: GET, POST, PATCH, DELETE


