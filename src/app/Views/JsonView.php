<?php

namespace App\Views;

class JsonView
{
    public static function render($data)
    {
        die(json_encode($data));
    }
}
