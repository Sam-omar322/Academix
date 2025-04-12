<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'user_id',
        'video_url',
        'thumbnail',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */



    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->withPivot('bought', 'price_at_purchase')
                    ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
