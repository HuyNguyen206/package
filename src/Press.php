<?php


namespace huynl\Press;


use Illuminate\Support\Str;

class Press
{
    protected $fields = [];
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

    public function fields($fields){
        $this->fields = array_merge($this->fields, $fields);
    }

    public function availableFields(){
        return array_reverse($this->fields);
    }

}