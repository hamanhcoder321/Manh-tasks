<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') | Task Manager </title>
    <link rel="shortcut icon" href="{{ asset('assets/img/download (1).jpg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

    <style>
        * {
            transition: all 0.3s ease;
        }

        body {
            display: flex;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: "Noto Sans", sans-serif !important;
        }

        .btn {
            padding: .35rem .75rem !important;
            font-size: .875rem !important;
            border-radius: 0.5rem !important;
            font-weight: 500 !important;
            border: none !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.3s ease !important;
        }

        .btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15) !important;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin: 5px 10px;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: #3498db;
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(52, 152, 219, 0.1);
        }

        .sidebar .nav-link:hover::before {
            transform: scaleY(1);
            transform-origin: bottom;
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(52, 152, 219, 0.2);
            font-weight: 600;
        }

        .sidebar .nav-link.active::before {
            transform: scaleY(1);
        }

        .sidebar .nav-link .bi {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        }

        .content::-webkit-scrollbar {
            width: 8px;
        }

        .content::-webkit-scrollbar-track {
            background: transparent;
        }

        .content::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .content::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.2);
        }

        .topnav {
            flex-shrink: 0;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 600;
            color: #2c3e50 !important;
            font-size: 1.1rem;
        }

        .navbar-nav .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 1rem !important;
            margin: 0 5px;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #3498db;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #3498db !important;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .dropdown-menu {
            border: none !important;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
            border-radius: 8px !important;
            padding: 8px 0 !important;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 10px 20px !important;
            transition: all 0.2s ease !important;
            color: #2c3e50 !important;
        }

        .dropdown-item:hover {
            background-color: #f0f4f8 !important;
            color: #3498db !important;
            padding-left: 25px !important;
        }

        .card {
            border: none !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
            border-radius: 12px !important;
            transition: all 0.3s ease !important;
            background: white;
        }

        .card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
            transform: translateY(-4px);
        }

        footer {
            background-color: #ffffff;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08) !important;
            flex-shrink: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px 0 !important;
        }

        footer .text-muted {
            color: #7f8c8d !important;
            font-weight: 500;
            font-size: 0.95rem;
        }

        main {
            flex-grow: 1;
            padding: 20px;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Animation for page load */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        body {
            animation: fadeIn 0.5s ease;
        }

        .sidebar-toggle {
            display: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            padding: 8px 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .sidebar-toggle::before {
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

        .sidebar-toggle:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
        }

        .sidebar-toggle:hover::before {
            width: 100px;
            height: 100px;
        }

        .sidebar-toggle:active {
            transform: translateY(0);
            box-shadow: 0 2px 6px rgba(102, 126, 234, 0.3);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            animation: fadeIn 0.3s ease;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                z-index: 1000;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                width: 250px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .content {
                padding: 0;
            }

            body.sidebar-open {
                overflow: hidden;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="sidebar d-flex flex-column p-3" id="sidebar">
        <h4 class="mb-4 text-center">
            <a href="{{ route('dashboard') }}">
                <img style=" filter: invert(100%) brightness(200%);"
                    src="{{ asset('assets/img/download (1).jpg') }}" class="img-fluid" width="80%"
                    alt="task manager">
            </a>
        </h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door"></i> Dasboard
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}"
                    href="{{ route('projects.index') }}">
                    <i class="bi bi-folder"></i> Dự án
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('tasks*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                    <i class="bi bi-check2-square"></i> Nhiệm vụ
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->is('files*') ? 'active' : '' }}" href="{{ route('files.index') }}">
                    <i class="bi bi-file"></i> Tệp
                </a>
            </li>
        </ul>
    </div>
    <div class="content d-flex flex-column">
        <header class="topnav mb-4">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="bi bi-list" ></i>
                    </button>
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <span class="fw-normal" id="currentDateTime"></span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem; color: #2c3e50;"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
        <footer class="mt-auto py-3 text-center">
            <div class="container">
                <span class="text-muted">@ {{ date('Y') }} Task Manager | Manh  </span>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar toggle functionality
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            document.body.classList.toggle('sidebar-open');
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        });

        // Close sidebar when a link is clicked on mobile
        const sidebarLinks = sidebar.querySelectorAll('.nav-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                }
            });
        });

        
    </script>
</body>

</html>
