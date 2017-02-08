<?php
 
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
 
class HtmlGenerator extends Facade {
 
    protected static function getFacadeAccessor()
    {
        return 'build';
    }
}