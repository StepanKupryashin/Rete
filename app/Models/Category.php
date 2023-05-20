<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    public $timestamps = false;

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'categories_topics');
    }

    public function scopeGetAll()
    {
        $data = $this->all();

        foreach ($data as $value) {
            $value->topics;
            foreach($value->topics as $t) {
                $t->author;
                $t->posts;
            }
        }

        return $data;
    }

    static function findById(int $id) {
        $data = Category::find($id);

        $data->topics;

        return $data;
    }
 }
