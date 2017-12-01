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

## Changelog

* 2017-11-30 - Added get routes
* 2017-12-01 - Added post, patch, delete routes



