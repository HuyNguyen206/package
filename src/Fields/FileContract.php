<?php


namespace huynl\Press\Fields;


abstract class FileContract
{
    public static function parse($type, $value)
    {
        return [$type => $value];
    }

}