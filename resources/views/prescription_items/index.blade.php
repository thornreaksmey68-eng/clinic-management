@extends('layouts.app')

@section('title', 'Prescription Items')

@section('page-subtitle', 'Prescription Items')

@section('content')

<div class="page-header">

<div>
    <div class="page-title">
        Prescription Items
    </div>

    <div class="page-description">
        Manage medicines prescribed to patients.
    </div>
</div>

<a href="{{ route('prescription-items.create') }}" class="btn-add">
    + Add Prescription Item
</a>

</div>

@if (session('success'))

<div class="success-alert">
    ✓ {{ session('success') }}
</div>

@endif

<div class="items-card">

<div class="card-header-custom">

    <div>

        <div class="card-title">
            Prescription Items
        </div>

        <div class="card-count">
            {{ $items->count() }} items
        </div>

    </div>

    <div class="search">

        <span class="search-icon">
            🔍
        </span>

        <input
            type="text"
            id="searchItem"
            placeholder="Search..."
        >

    </div>

</div>


<div style="overflow-x: auto;">

    <table class="items-table">

        <thead>

            <tr>

                <th>ID</th>

                <th>Patient</th>

                <th>Doctor</th>

                <th>Medicine</th>

                <th>Quantity</th>

                <th>Dosage</th>

                <th>Instruction</th>

                <th style="text-align: right;">
                    Actions
                </th>

            </tr>

        </thead>


        <tbody id="itemTable">

            @forelse ($items as $item)

                <tr>

                    <td>
                        <span class="item-id">
                            #{{ $item->id }}
                        </span>
                    </td>


                    <td>

                        <div class="person">

                            <div class="avatar">
                                {{ strtoupper(substr($item->prescription->patient->name ?? 'P', 0, 1)) }}
                            </div>

                            <div>

                                <div class="person-name">
                                    {{ $item->prescription->patient->name ?? 'Unknown' }}
                                </div>

                                <div class="person-id">
                                    Patient #{{ $item->prescription->patient_id ?? '-' }}
                                </div>

                            </div>

                        </div>

                    </td>


                    <td>

                        {{ $item->prescription->doctor->name ?? 'Unknown' }}

                    </td>


                    <td>

                        <div class="medicine">

                            <span class="medicine-icon">
                                💊
                            </span>

                            <div>

                                <div class="medicine-name">
                                    {{ $item->medicine->name ?? 'Unknown Medicine' }}
                                </div>

                                @if ($item->medicine?->medicine_code)

                                    <div class="medicine-code">
                                        {{ $item->medicine->medicine_code }}
                                    </div>

                                @endif

                            </div>

                        </div>

                    </td>


                    <td>

                        <span class="quantity">
                            {{ $item->quantity }}
                        </span>

                    </td>


                    <td>
                        {{ $item->dosage ?? '-' }}
                    </td>


                    <td>
                        {{ $item->instruction ?? '-' }}
                    </td>


                    <td>

                        <div class="actions">

                            <a
                                href="{{ route('prescription-items.show', $item->id) }}"
                                class="action-btn view-btn"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('prescription-items.edit', $item->id) }}"
                                class="action-btn edit-btn"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('prescription-items.destroy', $item->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Delete this prescription item?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-btn delete-btn"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="empty">

                        <div class="empty-icon">
                            💊
                        </div>

                        <div class="empty-title">
                            No prescription items found
                        </div>

                        <div class="empty-text">
                            Add a prescription item to get started.
                        </div>

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
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .page-description {
        font-size: 14px;
        color: #94a3b8;
    }

    .btn-add {
        background: #2563eb;
        color: white;
        border-radius: 10px;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }

    .btn-add:hover {
        background: #1d4ed8;
        color: white;
    }

    .success-alert {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        padding: 13px 16px;
        font-size: 13px;
        margin-bottom: 20px;
    }

    .items-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #eef0f4;
        box-shadow: 0 4px 20px rgba(15, 23, 42, .05);
        overflow: hidden;
    }

    .card-header-custom {
        padding: 23px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f1f5f9;
    }

    .card-title {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
    }

    .card-count {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 3px;
    }

    .search {
        width: 260px;
        position: relative;
    }

    .search input {
        width: 100%;
        height: 42px;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 0 15px 0 40px;
        font-size: 13px;
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 14px;
        top: 10px;
        color: #94a3b8;
    }

    .items-table {
        width: 100%;
        border-collapse: collapse;
    }

    .items-table th {
        background: #f8fafc;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        padding: 15px 18px;
        text-align: left;
    }

    .items-table td {
        padding: 17px 18px;
        font-size: 13px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .items-table tbody tr:hover {
        background: #fafcff;
    }

    .item-id {
        color: #2563eb;
        font-weight: 600;
    }

    .person {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .avatar {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .person-name {
        color: #334155;
        font-weight: 600;
    }

    .person-id {
        color: #94a3b8;
        font-size: 10px;
        margin-top: 2px;
    }

    .medicine {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .medicine-icon {
        width: 32px;
        height: 32px;
        background: #eff6ff;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .medicine-name {
        color: #334155;
        font-weight: 600;
    }

    .medicine-code {
        color: #94a3b8;
        font-size: 10px;
        margin-top: 2px;
    }

    .quantity {
        background: #f1f5f9;
        color: #334155;
        padding: 5px 9px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 5px;
    }

    .action-btn {
        border: none;
        background: transparent;
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        padding: 4px 7px;
    }

    .view-btn {
        color: #2563eb;
    }

    .edit-btn {
        color: #64748b;
    }

    .delete-btn {
        color: #dc2626;
    }

    .action-btn:hover {
        text-decoration: underline;
    }

    .empty {
        text-align: center;
        padding: 70px 20px !important;
    }

    .empty-icon {
        font-size: 45px;
        margin-bottom: 15px;
    }

    .empty-title {
        font-size: 15px;
        font-weight: 600;
        color: #334155;
    }

    .empty-text {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }

    @media (max-width: 900px) {

        .page-header {
            align-items: flex-start;
            gap: 15px;
        }

        .search {
            width: 200px;
        }

    }

</style>

<script>

    const searchInput =
        document.getElementById('searchItem');

    searchInput.addEventListener('keyup', function () {

        const searchValue =
            this.value.toLowerCase();

        const rows =
            document.querySelectorAll('#itemTable tr');

        rows.forEach(function (row) {

            const text =
                row.innerText.toLowerCase();

            row.style.display =
                text.includes(searchValue)
                    ? ''
                    : 'none';

        });

    });

</script>

@endsection
