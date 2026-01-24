@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            animation: slideInDown 0.6s ease;
        }

        .dashboard-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            font-size: 1.05rem;
            opacity: 0.95;
            margin-bottom: 0;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 28px;
        }

        .stat-icon.tasks {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stat-icon.files {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .stat-icon.projects {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .stat-icon.teams {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 10px 0;
        }

        .stat-label {
            color: #7f8c8d;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none !important;
            color: white;
            margin-top: 15px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .stat-card .btn:hover {
            transform: none;
            box-shadow: 0 6px 14px rgba(102, 126, 234, 0.4) !important;
            color: white;
        }

        .recent-tasks-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            animation: fadeInUp 0.8s ease 0.4s forwards;
            opacity: 0;
        }

        .recent-tasks-card .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .recent-tasks-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .recent-tasks-list li {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ecf0f1;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .recent-tasks-list li:last-child {
            border-bottom: none;
        }

        .recent-tasks-list li:hover {
            background-color: #f8f9fa;
            padding-left: 20px;
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, transparent 100%);
        }

        .task-title {
            color: #2c3e50;
            font-weight: 500;
            flex-grow: 1;
        }

        .badge {
            font-weight: 600;
            padding: 6px 12px !important;
            border-radius: 20px !important;
            font-size: 0.85rem;
        }

        .badge.todo {
            background: linear-gradient(135deg, #ffa751 0%, #ffe259 100%) !important;
            color: white;
        }

        .badge.inprogress {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white;
        }

        .badge.done {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%) !important;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .container {
            max-width: 1200px;
        }

        .row {
            margin-right: -12px;
            margin-left: -12px;
        }

        .col-md-3 {
            padding: 12px;
        }

        .col-md-6 {
            padding: 12px;
        }
    </style>

    <div class="container mt-4">
        <div class="dashboard-header">
            <h2><i class="bi bi-speedometer2"></i> Chào mừng đến Dashboard</h2>
            <p>Quản lý các dự án, nhiệm vụ và tệp tin của bạn một cách hiệu quả</p>
        </div>

        <div class="row mb-4">
            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <div class="stat-icon tasks">
                        <i class="bi bi-check2-square"></i>
                    </div>
                    <div class="stat-label">Tổng Nhiệm Vụ</div>
                    <div class="stat-number">{{ $tasksCount ?? 0 }}</div>
                    <p style="color: #95a5a6; font-size: 0.9rem; margin-bottom: 0;">Nhiệm vụ đang quản lý</p>
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Xem Nhiệm Vụ</a>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <div class="stat-icon files">
                        <i class="bi bi-file-earmark"></i>
                    </div>
                    <div class="stat-label">Tổng Tệp Tin</div>
                    <div class="stat-number">{{ $filesCount ?? 0 }}</div>
                    <p style="color: #95a5a6; font-size: 0.9rem; margin-bottom: 0;">Tệp được lưu trữ</p>
                    <a href="{{ route('files.index') }}" class="btn btn-primary">Xem Tệp Tin</a>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <div class="stat-icon projects">
                        <i class="bi bi-folder"></i>
                    </div>
                    <div class="stat-label">Dự Án</div>
                    <div class="stat-number">3</div>
                    <p style="color: #95a5a6; font-size: 0.9rem; margin-bottom: 0;">Dự án đang tiến hành</p>
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Xem Dự Án</a>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="stat-card">
                    <div class="stat-icon teams">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-label">Thành Viên</div>
                    <div class="stat-number">5</div>
                    <p style="color: #95a5a6; font-size: 0.9rem; margin-bottom: 0;">Thành viên nhóm</p>
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Xem Chi Tiết</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="recent-tasks-card">
                    <h5 class="card-title">
                        <i class="bi bi-lightning-charge"></i> Nhiệm Vụ Gần Đây
                    </h5>
                    @if($recentTasks && count($recentTasks) > 0)
                        <ul class="recent-tasks-list">
                            @foreach($recentTasks as $task)
                                <li>
                                    <span class="task-title">{{ $task->title }}</span>
                                    <span class="badge {{ $task->status == 'to_do' ? 'todo' : ($task->status == 'in_progress' ? 'inprogress' : 'done') }}">
                                        {{ $task->status == 'to_do' ? 'Chưa Làm' : ($task->status == 'in_progress' ? 'Đang Làm' : 'Hoàn Thành') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Chưa có nhiệm vụ nào</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="recent-tasks-card">
                    <h5 class="card-title">
                        <i class="bi bi-info-circle"></i> Thống Kê Nhanh
                    </h5>
                    <div style="padding: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; color: white; margin-bottom: 10px;">
                            <span style="font-weight: 600;">Nhiệm vụ chưa làm</span>
                            <span style="font-size: 1.5rem; font-weight: 700;">{{ $tasksCount ?? 0 }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 8px; color: white; margin-bottom: 10px;">
                            <span style="font-weight: 600;">Tệp tin</span>
                            <span style="font-size: 1.5rem; font-weight: 700;">{{ $filesCount ?? 0 }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px; color: white;">
                            <span style="font-weight: 600;">Hoàn thành</span>
                            <span style="font-size: 1.5rem; font-weight: 700;">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
