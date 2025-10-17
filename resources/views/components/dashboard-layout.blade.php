@aware(['user' => Auth::user()])

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PrimeBalance Dashboard</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>
<body id="app" class="dashboard">
<!--
  Material Icons by Google
  Licensed under the Apache License 2.0
  https://www.apache.org/licenses/LICENSE-2.0
-->
<div class="d-flex overflow-y-hidden">
    <button class="btn-menu d-md-none" id="burger"
            onclick="this.classList.toggle('opened'); this.setAttribute('aria-expanded', this.classList.contains('opened'))"
            aria-label="Main Menu">
        <svg width="40" height="40" viewBox="0 0 100 100">
            <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"/>
            <path class="line line2" d="M 20,50 H 80"/>
            <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"/>
        </svg>
    </button>

    <nav class="d-none col-12" id="nav-mobile">
        <div class="d-flex align-items-center vh-100 p-4">
            <ul class="nav nav-pills flex-column w-100">
                <li class="nav-item">
                    <x-nav-link href="/dashboard" :active="request()->is('dashboard')">
                        <span class="fs-4">Dashboard</span>
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link href="/transactions" :active="request()->is('transactions')">
                        <span class="fs-4">Transactions</span>
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link href="/goals" :active="request()->is('goals')">
                        <span class="fs-4">Goals</span>
                    </x-nav-link>
                </li>
            </ul>
        </div>
    </nav>

    <div id="sidebar" class="sidebar d-none d-md-flex flex-column px-3 py-4 vh-100">
        <div class="sidebar-header px-2 mb-4 d-flex justify-content-between">
            <p id="logo" class="mb-0 text-primary h5">PB</p>

            <button id="toggleSidebar" class="p-0 d-block btn btn-link">
                <img src="{{ asset('/images/dock-close.svg') }}" width="20" height="20" aria-hidden="true" alt="close dock icon">
            </button>
        </div>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <x-nav-link href="/dashboard" :active="request()->is('dashboard')">
                    <img src="@if(request()->is('dashboard')) {{ asset('/images/dashboard-filled.svg') }} @else {{ asset('/images/dashboard.svg') }} @endif" width="20" height="20" aria-hidden="true" alt="dashboard icon">
                    <span>Dashboard</span>
                </x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link href="/transactions" :active="request()->is('transactions')">
                    <img src="{{ asset('/images/transactions.svg') }}" width="20" height="20" aria-hidden="true" alt="transactions icon">
                    <span>Transactions</span>
                </x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link href="/goals" :active="request()->is('goals')">
                    <img src="@if(request()->is('goals')) {{ asset('/images/goals-filled.svg') }} @else {{ asset('/images/goals.svg') }} @endif" width="20" height="20" aria-hidden="true" alt="goals icon">
                    <span>Goals</span>
                </x-nav-link>
            </li>
        </ul>

        <div class="mt-auto">
            <a href="#" class="nav-link btn text-white py-2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('/images/user.svg') }}" width="20" height="20" aria-hidden="true" alt="user icon">
                <small>{{ $user->first_name . ' ' . $user->last_name }}</small>
            </a>
            <ul class="dropdown-menu text-sm shadow">
                <li>
                    <form action="/logout" method="POST" class="dropdown-item">
                        @csrf
                        @method('DELETE')
                        <button class="btn me-2 mb-2 w-100">
                            <img src="{{ asset('/images/logout.svg') }}" class="me-1" width="20" height="20" aria-hidden="true" alt="log out icon">
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content flex-grow-1">
        <div class="container-fluid py-4">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    const sidebar = document.querySelector('#sidebar');
    const toggle = document.querySelector('#toggleSidebar');
    const burgerBtn = document.querySelector('#burger');
    const menu = document.querySelector('#nav-mobile');
    const body = document.body;

    burgerBtn.addEventListener('click', () => {
        menu.classList.toggle('d-none');
        body.classList.toggle('menu-open');
    })

    if (localStorage.getItem('sidebar-expanded') === 'true') {
        sidebar.classList.add('expanded');
    }

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('expanded');
        localStorage.setItem('sidebar-expanded', sidebar.classList.contains('expanded'));
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('app').classList.add('loaded');

        const sidebar = document.querySelector('#sidebar');
        const toggleBtn = document.querySelector('#toggleSidebar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('expanded');
        })
    })
</script>

@stack('scripts')
</body>
</html>
