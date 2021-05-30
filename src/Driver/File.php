<?php


namespace huynl\Press\Driver;


use huynl\Press\PressFileParser;
use Illuminate\Support\Str;

abstract class File
{
    protected $posts = [];
    protected $config;

    protected abstract function fetchPosts();
    public function __construct()
    {
        $this->setConfig();
        $this->validateSource();
    }

    protected function setConfig(){
        $this->config = config('press.'.config('press.driver'));
    }

    protected function validateSource(){
        return true;
    }

    protected function parse($filePath, $fileName){
        $this->posts[] = array_merge((new PressFileParser($filePath))->getData(), ['identifier' => Str::slug($fileName)]) ;
    }
}