<?php


namespace huynl\Press;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PressFileParser
{

    private $fileName;
    private $data;
    private $rawData;

    public function __construct($fileName)
    {

        $this->fileName = $fileName;
        $this->splitFile();
        $this->explodeData();

        $this->processData();
    }

    protected function explodeData()
    {
        $data = explode("\n", trim($this->rawData[1]));
        foreach ($data as $s){
            preg_match('/(.*):\s?(.*)/',$s,$result);
                $this->data[$result[1]] = $result[2];
        }
        $this->data['body'] = trim($this->rawData[2]);
    }

    protected function processData(){
        foreach ($this->data as $field => $value){
            $class = $this->getField(Str::ucfirst($field));
            if(!class_exists($class) && !method_exists($class, 'parse')){
                $class = '\\huynl\\Press\\Fields\\Extra';
                $extra = $class::parse($field, $value)['extra'];
                if(isset($this->data['extra'])){
                    $this->data['extra'] = array_merge($this->data['extra'], $extra);
                }else{
                    $this->data['extra'] = $extra;
                }
            }
            else{
                $this->data = array_merge($this->data, $class::parse($field, $value));
            }
        }
        if (isset($extra)){
            $this->data['extra'] = json_encode($this->data['extra'], true);
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getRawData()
    {
        return $this->rawData;
    }

    private function splitFile()
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s',
            Storage::exists($this->fileName) ? Storage::get($this->fileName) : $this->fileName,
            $this->rawData
        );
    }

    private function getField($field)
    {
        foreach (\huynl\Press\Facades\Press::availableFields() as $availableField){
            $class = new \ReflectionClass($availableField);
            if($class->getShortName() == $field){
                return $class->getName();
            }

        }
    }
}