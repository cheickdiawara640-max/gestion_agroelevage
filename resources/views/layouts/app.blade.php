<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2D3748">
<link rel="apple-touch-icon" href="https://cdn-icons-png.flaticon.com/512/2371/2371831.png">
<link rel="manifest" href="{{ asset('manifest.json') }}">

<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
    <title>@yield('title','DTAE Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { min-height: 100vh; }
        .sidebar {
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #1F2937;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #374151;
            border-radius: 5px;
        }
        .main-content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
