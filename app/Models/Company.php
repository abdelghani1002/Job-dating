<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "companies";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'description',
        'logo',
    ];

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function (Company $company) {
            $company->announcements()->detach();
        });
    }
}
