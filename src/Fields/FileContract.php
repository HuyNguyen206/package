<?php


namespace Src\Fields;


abstract class FileContract
{
    public static function parse($type, $value)
    {
        return [$type => $value];
    }

}