<?php


namespace Tests\Feature;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use huynl\Press\MarkdownParser;
use huynl\Press\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function testPostCanBeCreatedWithFactory()
    {
//        fac
//        factory(Post::class)->create();
//        Factory::factoryForModel(Post::class)->create();
        \factory(Post::class)->create();
        $this->assertCount(1, Post::all());
    }
}