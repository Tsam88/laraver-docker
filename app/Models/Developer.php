<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role',
    ];

    // protected $hidden = ['pivot'];

    /**
     * The projects that belong to the developer.
     */
    public function projects(){

        return $this->belongsToMany(Project::class)->withPivot('id');

    }
}
