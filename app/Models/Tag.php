<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });

        static::updating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }

}
