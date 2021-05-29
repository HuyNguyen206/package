<?php


namespace huynl\Press\Fields;


use huynl\Press\MarkdownParser;

class Body extends FileContract
{
    public static function parse($type, $value)
    {
        return [$type => MarkdownParser::parse($value)];
    }

}