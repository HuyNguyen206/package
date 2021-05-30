<?php


namespace huynl\Press;


use Illuminate\Support\Str;

class Press
{
    public function configNotPublish(){
        return is_null(config('press'));
    }

    public function driver(){
        $driver = Str::ucfirst(config('press.driver'));
        $class = 'huynl\Press\Driver\\'.$driver.'Driver';
        return new $class;
    }

    public function prefixPath(){
        return config('press.prefix_path', 'press');
    }

}