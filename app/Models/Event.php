<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'image', 'content', 'published_at'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}