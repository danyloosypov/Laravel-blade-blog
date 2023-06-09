<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'thumbnail', 'body', 'active', 'published_at', 'user_id', 'meta_title', 'meta_description'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function shortBody() {
        return Str::words(strip_tags($this->body), 30);
    }

    public function getThumbnail() {
        if($this->thumbnail === null) {
            return null;
        }

        if(str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        } else {
            return '/storage/' . $this->thumbnail;
        }
    }
}
