@extends('layouts.app')
@section('title')
    Thêm dự án
@endsection
@section('content')
    <div class="container mb-3">
        <h2 class="mb-4 shadow-sm p-3 rounded bg-white">thêm dự án</h2>
        <div class="card border-0 shadow-sm m-auto" style="max-width: 600px;">
            <div class="card-body">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên dự án</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">ngày bắt đầu</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                        @error('start_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                        @error('end_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="not_started">Chưa tiến hành</option>
                            <option value="in_progress">Đang tiến hành</option>
                            <option value="completed">Hoàn thành</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Tạo dự án</button>
                </form>
            </div>
        </div>
    </div>
@endsection
