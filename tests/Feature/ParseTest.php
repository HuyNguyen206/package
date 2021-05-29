<?php


namespace Tests\Feature;


use huynl\Press\MarkdownParser;
use Tests\TestCase;

class ParseTest extends TestCase
{
    /** @test */
    public function testStringIsParse()
    {
//        $parseDown = new \Parsedown();
//        dd($parseDown->text('## Hello'));
//        $this->assertTrue(true);

        $this->assertEquals('<h1>Hello</h1>', MarkdownParser::parse("# Hello"));
    }
}