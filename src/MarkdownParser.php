<?php


namespace Src;


class MarkdownParser
{
    public static function parse($text){
        return \Parsedown::instance()->text($text);
    }

}