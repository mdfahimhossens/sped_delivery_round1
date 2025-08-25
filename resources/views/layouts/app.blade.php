<!DOCTYPE html>
<html>
<head>
    <title>Sped Delivery</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Sped Delivery</h1>
        @if(session('success'))
            <div style="color:green;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="color:red;">{{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
