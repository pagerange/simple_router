<?php

namespace App;

class View
{

    static public function show($view, $data = array())
    {
        extract($data);
        require __DIR__ . '/views/' . $view . '.view.php';
    }

}