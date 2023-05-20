<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function topic() {
        return $this->hasOne(Topic::class, 'id', 'topic_id');
    }

    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    static function getLasted(int $num) {
        $data = Post::orderBy('updated_at','DESC')->limit($num)->get();
        foreach ($data as $value) {
            $value->author;
            $value->topic;
        }
        return $data;
    }

    static function findById(int $id) {
        $data = Post::find($id);
        $data->author;
        return $data;
    }
}
