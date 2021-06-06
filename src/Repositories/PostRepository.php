<?php


namespace huynl\Press\Repositories;


use huynl\Press\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostRepository
{
    public function save($post)
    {
        Post::updateOrCreate(
            [
                'identifier' => $post['identifier']
            ],
            [
            'slug' => Str::slug($post['title']),
            'title' => $post['title'],
            'body' => $post['body'],
            'extra' => $this->extra($post)
        ]);
    }

    private function extra($post)
    {
        $extra = (array) json_decode($post['extra'] ?? ' ');
        $attributes = Arr::except($post, ['extra', 'title', 'body', 'identifier']);
        return json_encode(array_merge($extra, $attributes));
    }
}