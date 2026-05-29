<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Authentication') &mdash; Indibiz</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Custom Auth CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .auth-wrapper {
            width: 100%;
            padding: 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.5);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .auth-card:hover {
            transform: translateY(-5px);
        }

        .auth-header {
            background: linear-gradient(135deg, #05AFFD 0%, #0056b3 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .auth-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.1;
        }

        .auth-header h3 {
            font-weight: 700;
            margin: 0;
            font-size: 28px;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }

        .auth-header p {
            margin-top: 10px;
            margin-bottom: 0;
            font-weight: 300;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .auth-body {
            padding: 40px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            height: auto;
            border: 1px solid #e1e5eb;
            background-color: #f8f9fa;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(5, 175, 253, 0.15);
            border-color: #05AFFD;
            background-color: #ffffff;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .btn-auth {
            background: linear-gradient(135deg, #05AFFD 0%, #007bff 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(5, 175, 253, 0.3);
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(5, 175, 253, 0.4);
            color: white;
        }

        .auth-link {
            color: #05AFFD;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .auth-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .custom-control-label::before {
            border-radius: 5px;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #05AFFD;
            border-color: #05AFFD;
        }

        /* Decorative circle */
        .decoration-circle {
            position: fixed;
            border-radius: 50%;
            background: linear-gradient(135deg, #05AFFD 0%, #0056b3 100%);
            opacity: 0.1;
            z-index: -1;
        }
        
        .circle-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -100px;
        }
        
        .circle-2 {
            width: 600px;
            height: 600px;
            bottom: -150px;
            right: -150px;
        }

        @media (max-width: 576px) {
            .auth-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="decoration-circle circle-1"></div>
    <div class="decoration-circle circle-2"></div>

    <div class="auth-wrapper d-flex align-items-center justify-content-center">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
