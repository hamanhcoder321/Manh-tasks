@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container">
        <h2>Chào mừng đến Dashboard</h2>
        <p>Đây là trang tổng quan nơi bạn có thể quản lý các nhiệm vụ, lịch trình, ghi chú, và tệp tin</p>
        
        <div class="row mb-4">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Nhiệm vụ</h5>
                        <p class="card-text flex-grow-1">bạn <strong>{{ $tasksCount }}</strong> không có.</p>
                        <a href="{{ route('projects.index') }}" class="btn btn-primary mt-auto">xem nhiệm vụ</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Têp</h5>
                        <p class="card-text flex-grow-1">bạn không có <strong>{{ $filesCount }}</strong> tệp nào.</p>
                        <a href="{{ route('files.index') }}" class="btn btn-primary mt-auto">xem tệp</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">các nhiệm vụ gần đây</h5>
                        <ul class="list-group flex-grow-1">
                            @foreach($recentTasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $task->title }}
                                    <span class="badge bg-primary rounded-pill">{{ $task->status == 'to_do' ? 'To Do' : 'In Progress' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
