<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
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
        'password' => 'hashed',
    ];

    /**
     * Get all user's skills.
     */
    public function skills()
    {
        return $this->morphToMany(Skill::class, 'skillable');
    }

    /**
     * Apply to announcement.
     */
    public function apply_to_announcement(Announcement $announcement)
    {
        $this->applyed_announcements()->attach([$announcement->id]);
        return "attached";
    }

    /**
     * Get all user's apllyed announcements.
     */
    public function applyed_announcements()
    {
        return $this->belongsToMany(Announcement::class, "candidates");
    }

    /**
     * update user's skills.
     */
    public function update_skills(Collection $skills)
    {
        $this->skills()->sync($skills);
        return 'attached';
    }
}
