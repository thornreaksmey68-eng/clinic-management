<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - MediCare Clinic</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;

            background: #2563eb;
            color: white;

            border-radius: 16px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 30px;
            font-weight: 700;
        }

        .logo h1 {
            color: #1f2937;
            font-size: 25px;
            margin-bottom: 5px;
        }

        .logo p {
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 9px;

            font-family: 'Poppins', sans-serif;
            font-size: 14px;

            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Password */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);

            width: 35px;
            height: 35px;

            border: none;
            background: transparent;

            cursor: pointer;

            font-size: 18px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password:hover {
            background: #f3f4f6;
            border-radius: 6px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 22px;

            font-size: 13px;
            color: #6b7280;
        }

        .remember-row input {
            width: 15px;
            height: 15px;
            cursor: pointer;
        }

        .login-button {
            width: 100%;
            padding: 13px;

            border: none;
            border-radius: 9px;

            background: #2563eb;
            color: white;

            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;

            cursor: pointer;
            transition: 0.2s;
        }

        .login-button:hover {
            background: #1d4ed8;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 20px;

            font-size: 13px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .error-list {
            margin: 0;
            padding-left: 18px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;

            color: #9ca3af;
            font-size: 12px;
        }

        @media (max-width: 500px) {
            .login-card {
                padding: 30px 22px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-card">

        {{-- Logo --}}
        <div class="logo">

            <div class="logo-icon">
                M
            </div>

            <h1>MediCare</h1>

            <p>Clinic Management System</p>

        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="alert alert-error">

                <ul class="error-list">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Login Form --}}
        <form
            action="{{ route('login.submit') }}"
            method="POST"
        >

            @csrf


            {{-- Email --}}
            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
                >

            </div>


            {{-- Password --}}
            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <div class="password-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword()"
                        aria-label="Show or hide password"
                        title="Show password"
                    >
                        👁️
                    </button>

                </div>

            </div>


            {{-- Remember Me --}}
            <div class="remember-row">

                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    value="1"
                >

                <label for="remember">
                    Remember me
                </label>

            </div>


            {{-- Login Button --}}
            <button
                type="submit"
                class="login-button"
            >
                Login
            </button>

        </form>


        <div class="footer">
            © {{ date('Y') }} MediCare Clinic Management System
        </div>

    </div>

</div>


<script>
    function togglePassword() {

        const password = document.getElementById('password');
        const button = document.querySelector('.toggle-password');

        if (password.type === 'password') {

            password.type = 'text';

            button.textContent = '🙈';
            button.title = 'Hide password';

        } else {

            password.type = 'password';

            button.textContent = '👁️';
            button.title = 'Show password';

        }
    }
</script>

</body>
</html>