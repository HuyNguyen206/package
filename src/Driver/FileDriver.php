<?php


namespace huynl\Press\Driver;


use huynl\Press\Exceptions\FileDriverNotFoundException;
use huynl\Press\PressFileParser;
use Illuminate\Support\Facades\Storage;

class FileDriver extends File
{

    public function fetchPosts(){
        $folderPath = $this->config['path'];
        foreach (Storage::files($folderPath) as $filePath){
            $this->parse($filePath,basename($filePath, '.md'));
        }
        return $this->posts;
    }

    protected function validateSource()
    {
        if(!Storage::exists($this->config['path'])){
            throw new FileDriverNotFoundException('Directory at \''.$this->config['path'].'\' does not exists'
            .'.Check the directory path in the config file');
        }
    }
}