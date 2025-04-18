<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

//use Attribute;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use League\CommonMark\Normalizer\SlugNormalizer;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Mutador para asegurarnos de que el username siemrpe se gaurde en minusculas 

    protected function username(): Attribute
    {
        return Attribute::make(
            set: fn ($valor) => Str::slug($valor) // Convierte a formato URL
        );
    }

    // relacion para los modelos
    public function post()
    {
        return $this->hasMany(Post::class);
    }

    // relacion para elimnar los likes 
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // alamcena los seguidores de un ussuario
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

       // almacenar los usuarios que seguimos 
       public function followings()
       {
           return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
   
       }

    // comprobar si un ussuario ya sigue a otro 
    public function siguiendo(User $user)
    {
        return $this->followers->contains($user->id);

    }
 
}
