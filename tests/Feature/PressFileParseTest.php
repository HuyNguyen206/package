<?php


namespace Tests\Feature;


use Carbon\Carbon;
use huynl\Press\MarkdownParser;
use huynl\Press\PressFileParser;
use Tests\TestCase;

class PressFileParseTest extends TestCase
{
    /** @test */
    public function testMarkDownRegexFile()
    {

        $pressParser = new PressFileParser(__DIR__.'/../Blogs/press.md');
        $result = $pressParser->getRawData();
        $this->assertStringContainsString('title: My Title', $result[1]);
        $this->assertStringContainsString('description: Description here', $result[1]);
        $this->assertStringContainsString('Blog post body', $result[2]);
    }

    /** @test */
    public function testMarkDownByFileNameInstead()
    {

        $pressParser = new PressFileParser("---\r\ntitle: My Title\r\n---\r\nBlog post body");
        $result = $pressParser->getRawData();
        $this->assertStringContainsString('title: My Title', $result[1]);
        $this->assertStringContainsString('Blog post body', $result[2]);
    }

    /** @test */
    public function testHeadCanBeSeparate()
    {

        $pressParser = new PressFileParser(__DIR__.'/../Blogs/press.md');
        $result = $pressParser->getData();
        $this->assertEquals('My Title', $result['title']);
        $this->assertEquals('Description here', $result['description']);
    }

    /** @test */
    public function testBodyCanGet()
    {

        $pressParser = new PressFileParser(__DIR__.'/../Blogs/press.md');
        $result = $pressParser->getData();
        $this->assertEquals("<h1>Head</h1>\n<p>Blog post body</p>", $result['body']);
    }

    /** @test */
    public function testDateCanParseToCarbon()
    {

        $pressParser = new PressFileParser("---\r\ndate: June 20, 1992\r\n---\r\nBlog post body");
        $result = $pressParser->getData();
        $this->assertInstanceOf(Carbon::class, $result['date']);
        $this->assertEquals('06-20-1992',$result['date']->format('m-d-Y'));

    }
    /** @test */
    public function testGetExtraField()
    {

        $pressParser = new PressFileParser("---\r\nauthor: Nguyen Le Huy\r\n---\r\nBlog post body");
        $result = $pressParser->getData();
        $this->assertEquals(json_encode(['author' => 'Nguyen Le Huy']),$result['extra']);

    }

    /** @test */
    public function testGetMultipleExtraField()
    {

        $pressParser = new PressFileParser("---\r\nauthor: Nguyen Le Huy\r\nage: 29\r\n---\r\nBlog post body");
        $result = $pressParser->getData();
        $this->assertEquals(json_encode(['author' => 'Nguyen Le Huy', 'age' => "29"]),$result['extra']);

    }

    /** @test */
    public function testGetMultipleField()
    {

        $pressParser = new PressFileParser("---\r\ntitle: First title\r\ndescription: This is description\r\nauthor: Nguyen Le Huy\r\nage: 29\r\n---\r\nBlog post body");
        $result = $pressParser->getData();
        $this->assertEquals('First title',$result['title']);
        $this->assertEquals('This is description',$result['description']);
    }
}