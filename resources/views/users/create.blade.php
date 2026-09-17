@extends('layouts.app')

@section('title', 'Add User')
@section('page-subtitle', 'Create New User')

@section('content')

<div class="page-header">
    <div>
        <h2>Add New User</h2>
        <p>Create a new staff account for the clinic.</p>
    </div>

    <a href="{{ route('users.index') }}" class="btn-back">
        ← Back to Users
    </a>
</div>

<div class="card">

    @if($errors->any())
        <div class="alert error">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            {{-- Name --}}
            <div class="form-group">
                <label for="name">
                    Full Name <span>*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter full name"
                    required
                >
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">
                    Email Address <span>*</span>
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="example@gmail.com"
                    required
                >
            </div>

            {{-- Role --}}
            <div class="form-group">
                <label for="role">
                    Role <span>*</span>
                </label>

                <select id="role" name="role" required>
                    <option value="">Select Role</option>

                    <option
                        value="admin"
                        {{ old('role') === 'admin' ? 'selected' : '' }}
                    >
                        Admin
                    </option>

                    <option
                        value="doctor"
                        {{ old('role') === 'doctor' ? 'selected' : '' }}
                    >
                        Doctor
                    </option>

                    <option
                        value="receptionist"
                        {{ old('role') === 'receptionist' ? 'selected' : '' }}
                    >
                        Receptionist
                    </option>
                </select>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">
                    Password <span>*</span>
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                    required
                >
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <label for="password_confirmation">
                    Confirm Password <span>*</span>
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    required
                >
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('users.index') }}" class="btn-cancel">
                Cancel
            </a>

            <button type="submit" class="btn-save">
                Create User
            </button>
        </div>

    </form>

</div>

<style>

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.page-header h2 {
    margin: 0;
    font-size: 24px;
    color: #1f2937;
}

.page-header p {
    margin: 5px 0 0;
    color: #6b7280;
}

.btn-back {
    text-decoration: none;
    color: #475569;
    background: #f1f5f9;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
}

.btn-back:hover {
    background: #e2e8f0;
}

.card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
    max-width: 900px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 8px;
    font-weight: 600;
    color: #374151;
}

.form-group label span {
    color: #dc2626;
}

.form-group input,
.form-group select {
    width: 100%;
    box-sizing: border-box;
    padding: 12px 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    outline: none;
    background: white;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e5e7eb;
}

.btn-cancel,
.btn-save {
    padding: 11px 20px;
    border-radius: 8px;
    font-family: inherit;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
}

.btn-cancel {
    background: #f1f5f9;
    color: #475569;
}

.btn-cancel:hover {
    background: #e2e8f0;
}

.btn-save {
    background: #2563eb;
    color: white;
}

.btn-save:hover {
    background: #1d4ed8;
}

.alert {
    padding: 14px 16px;
    border-radius: 8px;
    margin-bottom: 25px;
}

.alert.error {
    background: #fee2e2;
    color: #991b1b;
}

.alert ul {
    margin: 8px 0 0;
    padding-left: 20px;
}

@media (max-width: 700px) {

    .form-grid {
        grid-template-columns: 1fr;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .card {
        padding: 20px;
    }

}

</style>

@endsection