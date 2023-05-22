<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'author_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'id');
    }


    static function findById(int $id)
    {
        $user = User::find($id);
        $user->posts;
        $user->topics;
        if ($user->roles->where('name', 'Админ')->isEmpty()) {
            $user->is_admin = false;
        } else {
            $user->is_admin = true;
        }
        return $user;
    }

    public function scopeUsers()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->posts;
            $user->topics;
            if ($user->roles->where('name', 'Админ')->isEmpty()) {
                $user->is_admin = false;
            } else {
                $user->is_admin = true;
            }
        }
        return $users;
    }
}
