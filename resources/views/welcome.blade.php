<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutor Management System</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #f9f9f9;
            padding-bottom: 20px;
            text-align: center;
            padding-top: 50px;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            padding: 10px 0;
        }
        .navbar a {
            float: right;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .header-img {
            width: 100%;
            height: auto;
        }
        .about {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1, p {
            margin: 10px 0;
        }
        .subject-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            text-align: center;
            padding: 0 20px;
        }
        .subject-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .subject-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .subject-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .subject-item h2 {
            margin-top: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ url('login') }}">Login</a>
        <a href="{{ url('registration') }}">Register</a>
    </div>
    <header>
        <h1>Welcome to the Tutor System</h1>
        
    </header>
    <div class="subject-list">
        <div class="subject-item">
            <img src="{{ asset('/asset/math.avif') }}" alt="Mathematics">
            <h2>Mathematics</h2>
        </div>
        <div class="subject-item">
            <img src="{{ asset('/asset/science.avif') }}" alt="Science">
            <h2>Science</h2>
        </div>
        <div class="subject-item">
            <img src="{{ asset('/asset/english.webp') }}" alt="English">
            <h2>English</h2>
        </div>
        <div class="subject-item">
            <img src="{{ asset('/asset/history.jpg') }}" alt="History">
            <h2>History</h2>
        </div>
        <div class="subject-item">
            <img src="{{ asset('/asset/geography.png') }}" alt="Geography">
            <h2>Geography</h2>
        </div>
        <div class="subject-item">
            <img src="{{ asset('/asset/physics.jfif') }}" alt="Physics">
            <h2>Physics</h2>
        </div>
        <!-- Add more subjects here -->
    </div>
</body>
</html>
