<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function getStatusLabelAttribute()
{
    $map = [
        'not_started' => 'Chưa tiến hành',
        'in_progress' => 'Đang tiến hành',
        'completed'   => 'Hoàn thành',
    ];

    return $map[$this->attributes['status']] ?? 'Không xác định';
}


    public function teamProjects()
    {
        return $this->belongsToMany(ProjectTeam::class, 'project_teams', 'project_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_teams', 'project_id', 'user_id');
    }
}
