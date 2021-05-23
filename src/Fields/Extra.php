<?php


namespace Src\Fields;


use Src\MarkdownParser;

class Extra extends FileContract
{
    public static function parse($type, $value)
    {
        return ['extra' => [$type => $value]];
    }

}