<?php


namespace huynl\Press;


use Illuminate\Support\Str;

class Press
{
    public static function configNotPublish(){
        return is_null(config('press'));
    }

    public static function driver(){
        $driver = Str::ucfirst(config('press.driver'));
        $class = 'huynl\Press\Driver\\'.$driver.'Driver';
        return new $class;
    }

}