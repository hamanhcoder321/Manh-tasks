<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [ // cho phép gán dũ liệu hàng loạt
        'user_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];


    // Định dạng ngày tháng cho start_date và end_date
    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Quan hệ giữa Project và User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ giữa Project và Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Quan hệ giữa Project và File
    public function files()
    {
        return $this->hasMany(File::class); 
    }


    // Accessor để lấy nhãn trạng thái tiếng Việt
    public function getStatusLabelAttribute()
    {
        $map = [
            'not_started' => 'Chưa tiến hành',
            'in_progress' => 'Đang tiến hành',
            'completed'   => 'Hoàn thành',
        ];

        return $map[$this->attributes['status']] ?? 'Không xác định';
    }


    // Quan hệ giữa Project và ProjectTeam (thành viên trong dự án)
    public function teamProjects()
    {
        return $this->belongsToMany(ProjectTeam::class, 'project_teams', 'project_id', 'user_id');
    }

    // Quan hệ giữa Project và User thông qua bảng trung gian project_teams
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_teams', 'project_id', 'user_id');
    }
}
