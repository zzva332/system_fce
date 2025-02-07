<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCE - @yield('title')</title>
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style-sign.css">
</head>
<body class="page-full">
    <main class="container container-full">
        <div class="p-3">
            <img src="/images/logo-black.png" width="45px"/>
        </div>
        @yield('content')
    </main>

    <script src="/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>