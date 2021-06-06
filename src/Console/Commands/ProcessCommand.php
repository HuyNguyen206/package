<?php


namespace huynl\Press\Console\Commands;


use huynl\Press\Facades\Press;
use huynl\Press\Post;

use huynl\Press\Repositories\PostRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';
    protected $description = 'Update blog posts';

    public function handle(PostRepository $postRepository){
        if(Press::configNotPublish()){
         return  $this->warn('Please publish the config file by running'.
             ' \'php artisan vendor:publish --tag=press-config\'');
        }
        try {
            $posts = Press::driver()->fetchPosts();
            $this->info('Number of post:'.count($posts));
            foreach ($posts as $post){
                $postRepository->save($post);
                $this->info('Already process post:'.$post['identifier']);
            }
        }catch (\Throwable $ex){
            $this->error($ex->getMessage());
        }


    }


}