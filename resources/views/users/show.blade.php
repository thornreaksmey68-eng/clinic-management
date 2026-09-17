@extends('layouts.app')

@section('title', 'User Details')
@section('page-subtitle', 'User Details')

@section('content')

<div class="page-header">
    <div>
        <h2>User Details</h2>
        <p>View staff account information.</p>
    </div>

    <a href="{{ route('users.index') }}" class="btn-back">
        ← Back to Users
    </a>
</div>

<div class="profile-card">

    <div class="profile-header">

        <div class="avatar">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <div>
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
        </div>

    </div>

    <div class="details">

        <div class="detail-item">
            <span class="label">Full Name</span>
            <span class="value">{{ $user->name }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Email Address</span>
            <span class="value">{{ $user->email }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Role</span>

            <span class="value">
                @if($user->role === 'admin')
                    <span class="badge admin">Admin</span>
                @elseif($user->role === 'doctor')
                    <span class="badge doctor">Doctor</span>
                @else
                    <span class="badge receptionist">
                        Receptionist
                    </span>
                @endif
            </span>
        </div>

        <div class="detail-item">
            <span class="label">Account Created</span>
            <span class="value">
                {{ $user->created_at->format('d M Y, h:i A') }}
            </span>
        </div>

        <div class="detail-item">
            <span class="label">Last Updated</span>
            <span class="value">
                {{ $user->updated_at->format('d M Y, h:i A') }}
            </span>
        </div>

    </div>

    <div class="actions">

        <a
            href="{{ route('users.edit', $user) }}"
            class="btn-edit"
        >
            ✏️ Edit User
        </a>

        @if($user->id !== auth()->id())

            <form
                action="{{ route('users.destroy', $user) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this user?');"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-delete">
                    🗑️ Delete User
                </button>
            </form>

        @endif

    </div>

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

.profile-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    max-width: 900px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 18px;
    padding-bottom: 25px;
    border-bottom: 1px solid #e5e7eb;
}

.avatar {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    background: #2563eb;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 25px;
    font-weight: 700;
}

.profile-header h2 {
    margin: 0;
    color: #1f2937;
}

.profile-header p {
    margin: 5px 0 0;
    color: #6b7280;
}

.details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0;
    margin-top: 10px;
}

.detail-item {
    padding: 20px 10px;
    border-bottom: 1px solid #f1f5f9;
}

.label {
    display: block;
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 7px;
}

.value {
    display: block;
    color: #1f2937;
    font-weight: 600;
}

.badge {
    display: inline-block;
    padding: 5px 11px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge.admin {
    background: #fee2e2;
    color: #b91c1c;
}

.badge.doctor {
    background: #dbeafe;
    color: #1d4ed8;
}

.badge.receptionist {
    background: #dcfce7;
    color: #15803d;
}

.actions {
    display: flex;
    gap: 10px;
    margin-top: 25px;
}

.btn-edit,
.btn-delete {
    border: none;
    padding: 11px 18px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.btn-edit {
    background: #dbeafe;
    color: #1d4ed8;
}

.btn-edit:hover {
    background: #bfdbfe;
}

.btn-delete {
    background: #fee2e2;
    color: #dc2626;
}

.btn-delete:hover {
    background: #fecaca;
}

@media (max-width: 700px) {

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .details {
        grid-template-columns: 1fr;
    }

    .profile-card {
        padding: 20px;
    }

    .actions {
        flex-wrap: wrap;
    }

}

</style>

@endsection