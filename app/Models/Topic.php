<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsToMany(Category::class, 'categories_topics');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'topic_id', 'id');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    static function getAll()
    {
        $data = Topic::all();
        foreach ($data as $d) {
            $d->category;
            $d->author;
        }
        return $data;
    }

    static function findById(int $id)
    {
        $topic = Topic::find($id);
        $topic->category;
        $topic->author;
        foreach ($topic->posts as $post) {
            $post->author;
        }
        return $topic;
    }
    public function scopeLastActivity()
    {
        $posts = Post::getLasted(5);
        $topics = [];
        foreach ($posts as $value) {
           $topics[] = $value->topic;
        }
        return $topics;
    }
}
