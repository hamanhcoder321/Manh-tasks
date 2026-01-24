<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Task Manager</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/download (1).jpg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <style>
        * {
            transition: all 0.3s ease;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            width: 100%;
        }

        .card {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3) !important;
            overflow: hidden;
            animation: slideUp 0.6s ease;
            background: white;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            padding: 40px 20px !important;
            text-align: center;
            border: none;
        }

        .card-header img {
            width: 80px;
            height: 80px;
            filter: invert(100%) brightness(200%);
            animation: slideUp 0.8s ease;
        }

        .card-body {
            padding: 40px 30px !important;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #f8f9fa;
        }

        .form-control:focus {
            border-color: #667eea !important;
            background-color: white;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15) !important;
            outline: none;
        }

        .form-control::placeholder {
            color: #bdc3c7;
        }

        .form-check-label {
            font-weight: 500;
            color: #2c3e50;
            font-size: 0.9rem;
        }

        .mb-3 {
            margin-bottom: 20px !important;
            animation: slideUp 0.8s ease backwards;
        }

        .mb-3:nth-child(1) { animation-delay: 0.1s; }
        .mb-3:nth-child(2) { animation-delay: 0.2s; }
        .mb-3:nth-child(3) { animation-delay: 0.3s; }

        .d-grid {
            animation: slideUp 0.8s ease 0.4s backwards;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            font-weight: 600;
            padding: 14px 20px;
            border-radius: 10px;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .text-danger {
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 6px;
            color: #e74c3c !important;
            display: block;
        }

        .form-control.is-invalid,
        .form-control:invalid {
            border-color: #e74c3c !important;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-top: 15px;
            text-align: center;
            animation: slideUp 0.8s ease 0.05s backwards;
        }

        .login-subtitle {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            animation: slideUp 0.8s ease 0.1s backwards;
        }

        @media (max-width: 576px) {
            .card {
                margin: 0;
            }

            .card-body {
                padding: 25px 20px !important;
            }

            .col-md-5 {
                max-width: 100%;
            }

            .btn-primary {
                padding: 12px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-center p-4 fs-1">
                    <img src="{{ asset('assets/img/download (1).jpg') }}" class="img-fluid" alt="task manager">
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="admin@example.com" required autofocus>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật Khẩu</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
