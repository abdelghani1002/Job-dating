<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the learners that are assigned this tag.
     */
    public function learners()
    {
        return $this->morphedByMany(User::class, 'skillable');
    }

    /**
     * Get all of the announcements that are assigned this tag.
     */
    public function announcements()
    {
        return $this->morphedByMany(Announcement::class, 'skillable');
    }
}
