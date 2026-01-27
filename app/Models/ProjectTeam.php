<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // gán trừ id không cho gán


    // Quan hệ giữa ProjectTeam và Project
    public function project()
    {
        return $this->belongsToMany(Project::class); // belongsToMany quan hệ nhiều nhiều
    }


    // Quan hệ giữa ProjectTeam và User
    public function user()
    {
        return $this->belongsToMany(User::class, 'project_teams', 'user_id', 'project_id');
    }
}
