<?php


namespace Src\Fields;


use Carbon\Carbon;

class Date extends FileContract
{

    public static function parse($type, $value)
    {
        return [$type => Carbon::parse($value)];
    }
}