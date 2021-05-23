<?php


namespace Src\Fields;


use Src\MarkdownParser;

class Body extends FileContract
{
    public static function parse($type, $value)
    {
        return [$type => MarkdownParser::parse($value)];
    }

}