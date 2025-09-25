<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PAUD Monitoring - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: #2c3e50;
            color: white;
            padding: 20px 10px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .content {
            flex: 1;
            padding: 20px;
            background: #f5f6fa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Admin</h4>
        <hr>
        <a href="{{ route('dashboard') }}">📊 Dashboard</a>
        <a href="#">👩‍🏫 Guru</a>
        <a href="#">👨‍👩‍👧 Wali Murid</a>
        <a href="#">🏫 Kelas</a>
        <a href="#">👧👦 Siswa</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-3">Logout</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
