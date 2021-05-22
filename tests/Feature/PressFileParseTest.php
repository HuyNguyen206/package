<?php


namespace Tests\Feature;


use Orchestra\Testbench\TestCase;
use Src\MarkdownParser;
use Src\PressFileParser;

class PressFileParseTest extends TestCase
{
    /** @test */
    public function testMarkDownRegexFile()
    {

        $pressParser = new PressFileParser(__DIR__.'/../Blogs/press.md');
        $result = $pressParser->getData();
        $this->assertStringContainsString('title: My Title', $result[1]);
        $this->assertStringContainsString('description: Description here', $result[1]);
        $this->assertStringContainsString('Blog post body', $result[2]);
    }
}