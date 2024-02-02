<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Company::class)->withTimestamps()->as('parteners');
    }

    /**
     * Add the announcements partners.
     */
    public function addParteners(array $parteners): string
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
}
