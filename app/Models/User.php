<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Firefly\FilamentBlog\Traits\HasBlog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * User Model
 * 
 * This model extends Laravel's default User model and integrates with the Firefly Blog system.
 * The HasBlog trait provides all the necessary relationships and methods for blog functionality.
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasBlog; // HasBlog trait adds blog functionality

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path', // For user avatars
        'description',        // User bio/description
        'url_link'           // Social media or website link
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

    /**
     * Get the user's initials for avatar fallback
     * 
     * This method creates initials from the user's name for display
     * when no profile photo is available.
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Determine if the user can comment on blog posts
     * 
     * This method is used by the Firefly Blog plugin to control
     * commenting permissions. Currently allows all authenticated users.
     */
    public function canComment(): bool
    {
        // Add your conditional logic here
        // For example: return $this->is_active && !$this->is_banned;
        return true;
    }

    /**
     * Get the user's profile photo URL
     * 
     * Returns either the uploaded profile photo or generates
     * a fallback avatar using the user's name.
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }
}
