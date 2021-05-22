<?php


namespace Src;


use Illuminate\Support\Facades\File;

class PressFileParser
{

    private $fileName;
    private $data;

    public function __construct($fileName)
    {

        $this->fileName = $fileName;
        $this->splitFile();
    }

    public function getData(){
        return $this->data;
    }
    private function splitFile(){
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s',
        File::get($this->fileName),
        $this->data
        );
    }
}