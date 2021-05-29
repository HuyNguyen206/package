<?php


namespace huynl\Press\Driver;


use huynl\Press\PressFileParser;
use Illuminate\Support\Facades\Storage;

class FileDriver
{

    public function fetchPosts(){
        $folderPath = config('press.path');
        foreach (Storage::files($folderPath) as $filePath){
            $posts[] = (new PressFileParser($filePath))->getData();
        }
        return $posts ?? [];
    }
}