@extends('layouts.app')

@section('title', 'Users')
@section('page-subtitle', 'User Management')

@section('content')

<div class="page-header">
    <div>
        <h2>Users Management</h2>
        <p>Manage clinic staff accounts and their roles.</p>
    </div>

    <a href="{{ route('users.create') }}" class="btn-primary">
        + Add User
    </a>
</div>

@if(session('success'))
    <div class="alert success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert error">
        {{ session('error') }}
    </div>
@endif

<div class="card">

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>

                        <td>{{ $user->email }}</td>

                        <td>
                            @if($user->role === 'admin')
                                <span class="badge admin">Admin</span>
                            @elseif($user->role === 'doctor')
                                <span class="badge doctor">Doctor</span>
                            @else
                                <span class="badge receptionist">
                                    Receptionist
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    href="{{ route('users.show', $user) }}"
                                    class="btn-view"
                                >
                                    View
                                </a>

                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>

                                @if($user->id !== auth()->id())
                                    <form
                                        action="{{ route('users.destroy', $user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-delete"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="empty">
                            No users found.
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>
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

.btn-primary {
    background: #2563eb;
    color: white;
    padding: 11px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
}

.btn-primary:hover {
    background: #1d4ed8;
}

.card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
}

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #f8fafc;
}

th {
    text-align: left;
    padding: 14px;
    font-size: 14px;
    color: #475569;
    border-bottom: 1px solid #e5e7eb;
}

td {
    padding: 15px 14px;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
}

tbody tr:hover {
    background: #f8fafc;
}

.badge {
    display: inline-block;
    padding: 5px 10px;
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
    align-items: center;
    gap: 7px;
}

.actions a,
.actions button {
    border: none;
    padding: 7px 11px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.btn-view {
    background: #f1f5f9;
    color: #334155;
}

.btn-edit {
    background: #dbeafe;
    color: #1d4ed8;
}

.btn-delete {
    background: #fee2e2;
    color: #dc2626;
}

.btn-view:hover {
    background: #e2e8f0;
}

.btn-edit:hover {
    background: #bfdbfe;
}

.btn-delete:hover {
    background: #fecaca;
}

.alert {
    padding: 13px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
}

.alert.success {
    background: #dcfce7;
    color: #166534;
}

.alert.error {
    background: #fee2e2;
    color: #991b1b;
}

.empty {
    text-align: center;
    padding: 40px;
    color: #9ca3af;
}

@media (max-width: 768px) {

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .actions {
        flex-wrap: wrap;
    }

}

</style>

@endsection