<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title', 'Admin Panel')</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #2c3e50;
            padding: 30px 20px;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }
        .sidebar h2 {
            margin-bottom: 2rem;
            text-align: center;
            font-size: 1.6rem;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .logout-form {
            margin-top: 2rem;
            text-align: center;
        }
        .logout-form button {
            padding: 10px 20px;
            background: #e74c3c;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }
        .content {
            margin-left: 240px;
            padding: 40px 50px;
            min-height: 100vh;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
        .card-content {
            flex: 1;
        }
        .card-content h3 {
            font-size: 1.1rem;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        .card-content span {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2980b9;
        }
        .card img {
            width: 48px;
            height: 48px;
            margin-left: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin</h2>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('editions.index') }}">Editions</a>
        <a href="{{ route('pages.all') }}">Pages</a>

        <form class="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
