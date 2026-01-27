<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [ // cho phép gán dũ liệu hàng loạt
        'user_id',
        'project_id',
        'title',
        'description',
        'due_date',
        'priority',
        'status',
    ];


    // Quan hệ giữa Task và User, mỗi Task thuộc về 1 User
    public function user()
    {
        return $this->belongsTo(User::class); // belongsTo quan hệ 1-nhiều
    }


    // Quan hệ giữa Task và Project, mỗi Task thuộc về 1 Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Accessor để lấy màu sắc dựa trên ưu tiên
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'to_do':
                return 'primary';
            case 'in_progress':
                return 'warning';
            case 'completed':
                return 'success';
            default:
                return 'secondary';
        }
    }

}
