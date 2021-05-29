<?php


namespace huynl\Press\Fields;


use huynl\Press\MarkdownParser;

class Extra extends FileContract
{
    public static function parse($type, $value)
    {
        return ['extra' => [$type => $value]];
    }

}