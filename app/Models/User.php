<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

     public function courses()
     {
         return $this->belongsToMany(Course::class, 'course_user')
                     ->withPivot('bought', 'price_at_purchase')
                     ->withTimestamps();
     }
 
     public function comments()
     {
         return $this->hasMany(Comment::class);
     }
 
     public function blogs()
     {
         return $this->hasMany(Blog::class);
     }

     public function isAdmin()
     {
         return $this->role === 'admin';
     }

     public function CoursesInCart()
     {
        // This method returns the courses that are in the user's cart but not yet purchased.
         return $this->belongsToMany('App\Models\Course')->withPivot(['bought', 'price_at_purchase'])->wherePivot('bought', False);
     }

     public function myCourses() {
        // This method returns the courses that the user has purchased.
        return $this->belongsToMany('App\Models\Course')->withPivot(['bought', 'price_at_purchase', 'created_at'])->wherePivot('bought', true);
     }
}
