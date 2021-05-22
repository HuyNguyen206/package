<?php


namespace Tests\Feature;


use Orchestra\Testbench\TestCase;
use Src\MarkdownParser;

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