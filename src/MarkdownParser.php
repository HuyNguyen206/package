<?php


namespace huynl\Press;


class MarkdownParser
{
    public static function parse($text){
        return \Parsedown::instance()->text($text);
    }

}