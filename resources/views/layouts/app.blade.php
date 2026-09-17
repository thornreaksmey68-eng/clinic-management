<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>@yield('title', 'Clinic Management System')</title>

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
>

<style>

    * {
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        margin: 0;
        background: #f5f7fb;
        color: #1e293b;
    }

    /* ================= SIDEBAR ================= */

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;

        width: 255px;

        background: #ffffff;

        border-right: 1px solid #e8edf3;

        padding: 24px 16px;

        overflow-y: auto;

        z-index: 1000;
    }

    /* ================= LOGO ================= */

    .logo {
        display: flex;
        align-items: center;

        gap: 12px;

        padding: 0 10px;

        margin-bottom: 42px;
    }

    .logo-icon {
        width: 44px;
        height: 44px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: linear-gradient(
            135deg,
            #2563eb,
            #3b82f6
        );

        color: white;

        border-radius: 13px;

        font-size: 21px;

        box-shadow:
            0 5px 15px rgba(37, 99, 235, 0.20);
    }

    .logo-text {
        font-size: 20px;

        font-weight: 700;

        color: #172033;

        letter-spacing: -0.4px;
    }

    .logo-text span {
        color: #2563eb;
    }

    /* ================= MENU TITLE ================= */

    .menu-title {
        padding: 0 12px;

        margin-bottom: 12px;

        color: #a0aec0;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: 1px;
    }

    /* ================= NAVIGATION ================= */

    .nav-link {
        position: relative;

        display: flex;
        align-items: center;

        gap: 13px;

        padding: 12px 14px;

        margin-bottom: 5px;

        color: #64748b;

        border-radius: 11px;

        text-decoration: none;

        font-size: 13px;

        font-weight: 500;

        transition: all 0.2s ease;
    }

    .nav-link:hover {
        background: #f5f8ff;

        color: #2563eb;

        transform: translateX(2px);
    }

    .nav-link.active {
        background: #eff6ff;

        color: #2563eb;

        font-weight: 600;
    }

    .nav-link.active::before {
        content: "";

        position: absolute;

        left: -16px;

        top: 8px;

        width: 4px;

        height: 28px;

        border-radius: 0 5px 5px 0;

        background: #2563eb;
    }

    .nav-icon {
        width: 25px;
        height: 25px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 16px;
    }

    .nav-text {
        flex: 1;
    }

    /* ================= MAIN ================= */

    .main {
        min-height: 100vh;

        margin-left: 255px;
    }

    /* ================= TOPBAR ================= */

    .topbar {
        min-height: 76px;

        padding: 12px 32px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        background: #ffffff;

        border-bottom: 1px solid #e8edf3;
    }

    .topbar-left {
        display: flex;

        flex-direction: column;
    }

    .topbar-title {
        font-size: 15px;

        font-weight: 600;

        color: #1e293b;
    }

    .topbar-subtitle {
        margin-top: 2px;

        color: #94a3b8;

        font-size: 11px;
    }

    /* ================= USER MENU ================= */

    .user-menu {
        position: relative;
    }

    .user-button {
        display: flex;

        align-items: center;

        gap: 10px;

        border: none;

        background: transparent;

        padding: 6px 8px;

        border-radius: 12px;

        cursor: pointer;

        font-family: 'Poppins', sans-serif;

        transition: background 0.2s ease;
    }

    .user-button:hover {
        background: #f8fafc;
    }

    .user-avatar {
        width: 40px;
        height: 40px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background: linear-gradient(
            135deg,
            #2563eb,
            #3b82f6
        );

        color: white;

        font-size: 14px;

        font-weight: 600;
    }

    .user-info {
        text-align: left;

        min-width: 140px;
    }

    .user-name {
        color: #1e293b;

        font-size: 12px;

        font-weight: 600;
    }

    .user-email {
        margin-top: 2px;

        color: #94a3b8;

        font-size: 10px;
    }

    .user-role {
        margin-top: 2px;

        color: #2563eb;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;
    }

    .user-arrow {
        color: #94a3b8;

        font-size: 14px;

        margin-left: 4px;
    }

    /* ================= USER DROPDOWN ================= */

    .user-dropdown {
        display: none;

        position: absolute;

        top: calc(100% + 10px);

        right: 0;

        width: 280px;

        background: #ffffff;

        border: 1px solid #e8edf3;

        border-radius: 14px;

        padding: 10px;

        box-shadow:
            0 12px 35px rgba(15, 23, 42, 0.12);

        z-index: 2000;
    }

    .user-dropdown.show {
        display: block;
    }

    .dropdown-header {
        display: flex;

        align-items: center;

        gap: 11px;

        padding: 10px;
    }

    .dropdown-avatar {
        width: 44px;
        height: 44px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background: #eff6ff;

        color: #2563eb;

        font-size: 14px;

        font-weight: 600;
    }

    .dropdown-name {
        color: #1e293b;

        font-size: 12px;

        font-weight: 600;
    }

    .dropdown-email {
        margin-top: 3px;

        color: #94a3b8;

        font-size: 10px;

        word-break: break-all;
    }

    .dropdown-role {
        display: inline-block;

        margin-top: 5px;

        padding: 3px 7px;

        background: #eff6ff;

        color: #2563eb;

        border-radius: 6px;

        font-size: 8px;

        font-weight: 600;

        text-transform: uppercase;
    }

    .dropdown-divider {
        height: 1px;

        background: #eef2f7;

        margin: 6px 0;
    }

    /* ================= LOGOUT ================= */

    .dropdown-logout {
        width: 100%;

        display: flex;

        align-items: center;

        gap: 10px;

        padding: 11px 10px;

        border: none;

        border-radius: 9px;

        background: transparent;

        color: #dc2626;

        font-family: 'Poppins', sans-serif;

        font-size: 12px;

        font-weight: 500;

        text-align: left;

        cursor: pointer;

        transition: background 0.2s ease;
    }

    .dropdown-logout:hover {
        background: #fef2f2;
    }

    .dropdown-logout-icon {
        width: 25px;
        height: 25px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 7px;

        background: #fee2e2;

        font-size: 14px;
    }

    /* ================= CONTENT ================= */

    .content {
        padding: 32px;
    }

    /* ================= SCROLLBAR ================= */

    .sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #e2e8f0;

        border-radius: 10px;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 1000px) {

        .sidebar {
            width: 75px;

            padding: 20px 10px;
        }

        .logo {
            justify-content: center;

            padding: 0;
        }

        .logo-text,
        .menu-title,
        .nav-text {
            display: none;
        }

        .nav-link {
            justify-content: center;
        }

        .nav-link.active::before {
            left: -10px;
        }

        .main {
            margin-left: 75px;
        }

        .content {
            padding: 22px;
        }
    }

    @media (max-width: 600px) {

        .topbar {
            padding: 12px 18px;
        }

        .user-info,
        .user-arrow {
            display: none;
        }

        .user-button {
            padding: 3px;
        }

        .user-dropdown {
            width: 250px;
        }

        .content {
            padding: 16px;
        }
    }

    @media (max-width: 500px) {

        .topbar-title {
            font-size: 13px;
        }

        .topbar-subtitle {
            font-size: 9px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
        }
    }

</style>
```

</head>

<body>

```
<!-- ================= SIDEBAR ================= -->

<aside class="sidebar">

    <!-- LOGO -->

    <div class="logo">

        <div class="logo-icon">
            🏥
        </div>

        <div class="logo-text">
            Medi<span>Care</span>
        </div>

    </div>


    <!-- MAIN MENU -->

    <div class="menu-title">
        Main Menu
    </div>


    <nav>

        <!-- DASHBOARD -->
        <a
            href="{{ route('dashboard') }}"
            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
        >

            <span class="nav-icon">
                📊
            </span>

            <span class="nav-text">
                Dashboard
            </span>

        </a>


        <!-- PATIENTS -->
        @if(in_array(auth()->user()->role, ['admin', 'doctor', 'receptionist']))

            <a
                href="{{ route('patients.index') }}"
                class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    👥
                </span>

                <span class="nav-text">
                    Patients
                </span>

            </a>

        @endif


        <!-- DOCTORS -->
        @if(auth()->user()->role === 'admin')

            <a
                href="{{ route('doctors.index') }}"
                class="nav-link {{ request()->routeIs('doctors.*') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    👨‍⚕️
                </span>

                <span class="nav-text">
                    Doctors
                </span>

            </a>

        @endif


        <!-- APPOINTMENTS -->
        @if(in_array(auth()->user()->role, ['admin', 'doctor', 'receptionist']))

            <a
                href="{{ route('appointments.index') }}"
                class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    📅
                </span>

                <span class="nav-text">
                    Appointments
                </span>

            </a>

        @endif


        <!-- MEDICINES -->
        @if(auth()->user()->role === 'admin')

            <a
                href="{{ route('medicines.index') }}"
                class="nav-link {{ request()->routeIs('medicines.*') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    💊
                </span>

                <span class="nav-text">
                    Medicines
                </span>

            </a>

        @endif


        <!-- PRESCRIPTIONS -->
        @if(in_array(auth()->user()->role, ['admin', 'doctor']))

            <a
                href="{{ route('prescriptions.index') }}"
                class="nav-link {{ request()->routeIs('prescriptions.*') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    📋
                </span>

                <span class="nav-text">
                    Prescriptions
                </span>

            </a>

        @endif


        <!-- PAYMENTS -->
        @if(in_array(auth()->user()->role, ['admin', 'receptionist']))

            <a
                href="{{ route('payments.index') }}"
                class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    💰
                </span>

                <span class="nav-text">
                    Payments
                </span>

            </a>

        @endif

    </nav>


    <!-- SYSTEM -->

    <div
        class="menu-title"
        style="margin-top: 28px;"
    >
        System
    </div>


    <!-- SETTINGS -->

    @if(auth()->user()->role === 'admin')
    <a href="{{ route('users.index') }}" class="nav-link">
        ⚙️ User Management
    </a>
@endif

</aside>


<!-- ================= MAIN ================= -->

<main class="main">


    <!-- ================= TOPBAR ================= -->

    <header class="topbar">

        <div class="topbar-left">

            <div class="topbar-title">
                Clinic Management System
            </div>

            <div class="topbar-subtitle">
                @yield('page-subtitle', 'Management System')
            </div>

        </div>


        <!-- ================= USER ================= -->

        @auth

            <div class="user-menu">

                <button
                    type="button"
                    class="user-button"
                    onclick="toggleUserMenu()"
                >

                    <!-- Avatar -->

                    <div class="user-avatar">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>


                    <!-- User information -->

                    <div class="user-info">

                        <div class="user-name">
                            {{ auth()->user()->name }}
                        </div>

                        <div class="user-email">
                            {{ auth()->user()->email }}
                        </div>

                        <div class="user-role">
                            {{ auth()->user()->role }}
                        </div>

                    </div>


                    <span class="user-arrow">
                        ▾
                    </span>

                </button>


                <!-- ================= DROPDOWN ================= -->

                <div
                    class="user-dropdown"
                    id="userDropdown"
                >

                    <div class="dropdown-header">


                        <!-- Avatar -->

                        <div class="dropdown-avatar">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>


                        <!-- Information -->

                        <div>

                            <div class="dropdown-name">
                                {{ auth()->user()->name }}
                            </div>

                            <div class="dropdown-email">
                                {{ auth()->user()->email }}
                            </div>

                            <span class="dropdown-role">
                                {{ auth()->user()->role }}
                            </span>

                        </div>

                    </div>


                    <div class="dropdown-divider"></div>


                    <!-- Logout -->

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="dropdown-logout"
                        >

                            <span class="dropdown-logout-icon">
                                ↪
                            </span>

                            <span>
                                Logout
                            </span>

                        </button>

                    </form>

                </div>

            </div>

        @endauth

    </header>


    <!-- ================= PAGE CONTENT ================= -->

    <section class="content">

        @yield('content')

    </section>

</main>


<!-- ================= JAVASCRIPT ================= -->

<script>

    function toggleUserMenu() {

        const dropdown =
            document.getElementById('userDropdown');

        if (dropdown) {
            dropdown.classList.toggle('show');
        }

    }


    document.addEventListener('click', function (event) {

        const userMenu =
            document.querySelector('.user-menu');

        const dropdown =
            document.getElementById('userDropdown');

        if (
            userMenu &&
            dropdown &&
            !userMenu.contains(event.target)
        ) {

            dropdown.classList.remove('show');

        }

    });

</script>
```

</body>

</html>
