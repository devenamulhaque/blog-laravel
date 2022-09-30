<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
        return collect(File::files(resource_path("posts")))
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($document) => new Post(
                $document->title,
                $document->slug,
                $document->excerpt,
                $document->date,
                $document->body()
            ))->sortByDesc('date');
    }

    public static function find($slug){
       $posts = static::all();
       return $posts->firstWhere('slug', $slug);
    }
}
