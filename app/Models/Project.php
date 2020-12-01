<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'code',
        'due_date',
    ];

    /**
     * The Developers that belong to the project.
     */
    public function developers()
    {
        return $this->belongsToMany(Developer::class)->withPivot('id');
    }
}
