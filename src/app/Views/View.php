<?php

namespace App\Views;

class View
{
    public static function render($viewPath, $message)
    {
        extract($message);
        include "$viewPath.php";
    }
}
