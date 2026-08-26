<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(FaqItem::class);
    }
}