<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class Post
{

    public $title;
    public $slug;
    public $excerpt;
    public $date;
    public $body;

    public function __construct($title, $example, $excerpt, $date, $body)
    {
        $this->title = $title;
        $this->slug = $example;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
    }

    public static function all(){
        $files = File::files(resource_path("posts/"));
        return array_map(function ($file){
            return $file->getContents();
        }, $files);
    }

    public static function find($slug){
        if(!file_exists($path = resource_path("posts/{$slug}.html"))){
            return redirect('/');
        }

        return cache()->remember('posts.{$slug}', 5, fn() => file_get_contents($path));

    }
}
