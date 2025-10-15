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
<body class="dashboard">
<!--
  Material Icons by Google
  Licensed under the Apache License 2.0
  https://www.apache.org/licenses/LICENSE-2.0
-->
<div class="d-flex">
    <div id="sidebar" class="sidebar d-flex flex-column px-3 py-4 vh-100">
        <div class="sidebar-header mb-4 d-flex justify-content-between">
            <p id="logo" class="mb-0 text-primary h5">PB</p>

            <button id="toggleSidebar" class="p-0 d-block btn btn-link">
                <svg width="20" height="20" aria-hidden="true">
                    <use href={{ asset('images/dock-close.svg') }}></use>
                </svg>
            </button>
        </div>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <x-nav-link href="/dashboard" :active="request()->is('dashboard')">
                    <svg width="20" height="20" aria-hidden="true">
                        <use href="@if(request()->is('dashboard')) {{ asset('images/dashboard-filled.svg') }} @else {{ asset('images/dashboard.svg') }} @endif"></use>
                    </svg>
                    <span>Dashboard</span>
                </x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link href="/transactions" :active="request()->is('transactions')">
                    <svg width="20" height="20" aria-hidden="true">
                        <use href={{ asset('images/transactions.svg') }}></use>
                    </svg>
                    <span>Transactions</span>
                </x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link href="/goals" :active="request()->is('goals')">
                    <svg width="20" height="20" aria-hidden="true">
                        <use href="@if(request()->is('goals')) {{ asset('images/goals-filled.svg') }} @else {{ asset('images/goals.svg') }} @endif"></use>
                    </svg>
                    <span>Goals</span>
                </x-nav-link>
            </li>
        </ul>

        <div class="mt-auto">
            <a href="#" class="nav-link btn text-white py-2" data-bs-toggle="dropdown" aria-expanded="false">
                <svg width="20" height="20" aria-hidden="true">
                    <use href={{ asset('images/user.svg') }}></use>
                </svg>
                <small>{{ $user->first_name . ' ' . $user->last_name }}</small>
            </a>
            <ul class="dropdown-menu text-sm shadow">
                <li>
                    <form action="/logout" method="POST" class="dropdown-item">
                        @csrf
                        @method('DELETE')
                        <button class="btn me-2 mb-2 w-100">
                            <svg class="me-1" width="20" height="20" aria-hidden="true">
                                <use href={{ asset('images/logout.svg') }}></use>
                            </svg>
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
