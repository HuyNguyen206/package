<?php


namespace huynl\Press\Console\Commands;


use huynl\Press\Post;
use huynl\Press\Press;
use huynl\Press\PressFileParser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';
    protected $description = 'Update blog posts';

    public function handle(){
        if(Press::configNotPublish()){
         return  $this->warn('Please publish the config file by running'.
             ' \'php artisan vendor:publish --tag=press-config\'');
        }
        $posts = Press::driver()->fetchPosts();

       foreach ($posts as $post){
           Post::create([
               'identifier' => Str::random(),
               'slug' => Str::slug($post['title']),
               'title' => $post['title'],
               'body' => $post['body'],
               'extra' => $post['extra'] ?? null
           ]);
       }

    }


}