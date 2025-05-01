<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'FashionablyLate')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('page_css')
</head>

<body>
    <header class="header">
        <h1 class="serif-title">FashionablyLate</h1>
        @yield('header_button')
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>