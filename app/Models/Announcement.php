<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    /**
     * Add the announcements partners.
     */
    public function update_parteners(Collection $parteners): string
    {
        $this->companies()->sync($parteners);
        return "attached";
    }

    /**
     * Add the announcements partners.
     */
    public function removeParteners(Collection $parteners): string
    {
        $this->companies()->detach($parteners);
        return "dettached";
    }

    /**
     * Get all announcement's required skills.
     */
    public function skills()
    {
        return $this->morphToMany(Skill::class, 'skillable');
    }

    /**
     * update announcement's required skills.
     */
    public function update_skills(Collection $skills)
    {
        $this->skills()->sync($skills);
        return 'attached';
    }
}
