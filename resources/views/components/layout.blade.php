<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PrimeBalance</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>
<body id="app" class="layout bg-white d-flex flex-column min-vh-100">
<!--
  Material Icons by Google
  Licensed under the Apache License 2.0
  https://www.apache.org/licenses/LICENSE-2.0
-->
<nav class="navbar navbar-expand-md border-bottom mb-4 py-4 px-3">
    <div class="container">
        <a href="/" class="d-block mb-0 text-decoration-none h5 me-4"><span class="text-primary">Prime</span>Balance</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="navbar-collapse collapse" id="navbarCollapse" style="">
            <ul class="navbar-nav me-auto my-4 my-md-0">
                <li class="nav-item"><a class="nav-link text-grey active" aria-current="page" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link text-grey" href="#">Link</a></li>
            </ul>
            @guest
                <div class="text-end">
                    <a href="/login" type="button" class="btn btn-outline-primary me-2">Log In</a>
                    <a href="/register" type="button" class="btn btn-primary">Sign-up</a>
                </div>
            @endguest
        </div>
    </div>
</nav>

<main class="container d-flex flex-column justify-content-center flex-grow-1">{{ $slot }}</main>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-4 border-top">
        <p class="mb-0 text-body-secondary">© 2025 alexcoder001</p>
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('app').classList.add('loaded');
    })
</script>
</body>
</html>
