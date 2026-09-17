blade
@extends('layouts.app')

@section('title', 'Medicines')

@section('page-subtitle', 'Medicine Management')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .page-header h2 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .page-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 18px;
        border-radius: 10px;
        background: #2563eb;
        color: white;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-add:hover {
        background: #1d4ed8;
        color: white;
        transform: translateY(-1px);
    }

    /* Statistics */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .stat-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 25px;
        font-weight: 700;
        color: #111827;
    }

    /* Search */
    .toolbar {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        flex: 1;
        min-width: 250px;
    }

    .search-box input {
        width: 100%;
        padding: 11px 15px 11px 40px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        outline: none;
        font-size: 14px;
        box-sizing: border-box;
    }

    .search-box input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    /* Table */
    .table-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    thead {
        background: #f9fafb;
    }

    th {
        padding: 14px 18px;
        text-align: left;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #6b7280;
        font-weight: 700;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    td {
        padding: 15px 18px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #374151;
        vertical-align: middle;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .medicine-name {
        font-weight: 650;
        color: #111827;
    }

    .medicine-code {
        font-family: monospace;
        font-size: 13px;
        color: #6b7280;
    }

    .category-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 600;
    }

    .stock {
        font-weight: 700;
    }

    .stock-low {
        color: #dc2626;
    }

    .stock-normal {
        color: #16a34a;
    }

    .stock-empty {
        color: #dc2626;
    }

    .price {
        font-weight: 600;
        color: #111827;
    }

    .expiry-normal {
        color: #374151;
    }

    .expiry-warning {
        color: #d97706;
        font-weight: 600;
    }

    .expiry-expired {
        color: #dc2626;
        font-weight: 700;
    }

    /* Actions */
    .actions {
        display: flex;
        gap: 7px;
        align-items: center;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: 0.2s;
        font-size: 14px;
    }

    .btn-view {
        background: #eff6ff;
        color: #2563eb;
    }

    .btn-view:hover {
        background: #dbeafe;
    }

    .btn-edit {
        background: #f0fdf4;
        color: #16a34a;
    }

    .btn-edit:hover {
        background: #dcfce7;
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #fee2e2;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
        color: #6b7280;
    }

    .empty-state-icon {
        font-size: 40px;
        margin-bottom: 12px;
    }

    .empty-state h3 {
        margin: 0 0 6px;
        color: #374151;
        font-size: 18px;
    }

    .empty-state p {
        margin: 0 0 18px;
        font-size: 14px;
    }

    /* Alert */
    .alert-success {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        padding: 13px 16px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .page-header {
            align-items: flex-start;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }
    }
</style>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert-success">
        ✓ {{ session('success') }}
    </div>
@endif

{{-- Page Header --}}
<div class="page-header">
    <div>
        <h2>Medicines</h2>
        <p>Manage medicines, stock, prices and expiry dates.</p>
    </div>

    <a href="{{ route('medicines.create') }}" class="btn-add">
        <span>＋</span>
        Add Medicine
    </a>
</div>

{{-- Statistics --}}
@php
    $totalMedicines = $medicines->count();
    $totalStock = $medicines->sum('quantity');
    $lowStock = $medicines->where('quantity', '>', 0)->where('quantity', '<=', 10)->count();
    $outOfStock = $medicines->where('quantity', 0)->count();
@endphp

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-label">Total Medicines</div>
        <div class="stat-value">{{ $totalMedicines }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Total Stock</div>
        <div class="stat-value">{{ number_format($totalStock) }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Low Stock</div>
        <div class="stat-value">{{ $lowStock }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Out of Stock</div>
        <div class="stat-value">{{ $outOfStock }}</div>
    </div>

</div>

{{-- Search --}}
<div class="toolbar">
    <div class="search-box">
        <span class="search-icon">⌕</span>
        <input
            type="text"
            id="medicineSearch"
            placeholder="Search medicine, code, category..."
        >
    </div>
</div>

{{-- Medicine Table --}}
<div class="table-card">

    @if($medicines->count() > 0)

        <div class="table-wrapper">

            <table id="medicineTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Medicine</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Expiry Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($medicines as $medicine)

                        @php
                            $expiryClass = 'expiry-normal';

                            if ($medicine->expiry_date) {
                                if ($medicine->expiry_date->isPast()) {
                                    $expiryClass = 'expiry-expired';
                                } elseif ($medicine->expiry_date->diffInDays(now()) <= 30) {
                                    $expiryClass = 'expiry-warning';
                                }
                            }

                            if ($medicine->quantity == 0) {
                                $stockClass = 'stock-empty';
                            } elseif ($medicine->quantity <= 10) {
                                $stockClass = 'stock-low';
                            } else {
                                $stockClass = 'stock-normal';
                            }
                        @endphp

                        <tr class="medicine-row">

                            <td>
                                #{{ $medicine->id }}
                            </td>

                            <td>
                                <div class="medicine-name">
                                    {{ $medicine->name }}
                                </div>

                                <div class="medicine-code">
                                    {{ $medicine->medicine_code }}
                                </div>
                            </td>

                            <td>
                                @if($medicine->category)
                                    <span class="category-badge">
                                        {{ $medicine->category }}
                                    </span>
                                @else
                                    <span style="color:#9ca3af;">—</span>
                                @endif
                            </td>

                            <td>
                                {{ $medicine->unit }}
                            </td>

                            <td>
                                <span class="stock {{ $stockClass }}">
                                    {{ number_format($medicine->quantity) }}
                                </span>
                            </td>

                            <td>
                                <span class="price">
                                    ${{ number_format((float) $medicine->price, 2) }}
                                </span>
                            </td>

                            <td>
                                @if($medicine->expiry_date)
                                    <span class="{{ $expiryClass }}">
                                        {{ $medicine->expiry_date->format('d M Y') }}
                                    </span>
                                @else
                                    <span style="color:#9ca3af;">No expiry</span>
                                @endif
                            </td>

                            <td>

                                <div class="actions">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('medicines.show', $medicine) }}"
                                        class="action-btn btn-view"
                                        title="View"
                                    >
                                        👁
                                    </a>

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('medicines.edit', $medicine) }}"
                                        class="action-btn btn-edit"
                                        title="Edit"
                                    >
                                        ✎
                                    </a>

                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('medicines.destroy', $medicine) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this medicine?');"
                                        style="display:inline;"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn btn-delete"
                                            title="Delete"
                                        >
                                            🗑
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="empty-state">

            <div class="empty-state-icon">💊</div>

            <h3>No Medicines Found</h3>

            <p>There are currently no medicines in the system.</p>

            <a href="{{ route('medicines.create') }}" class="btn-add">
                ＋ Add Your First Medicine
            </a>

        </div>

    @endif

</div>

{{-- Search Script --}}
<script>
    document.getElementById('medicineSearch')?.addEventListener('keyup', function () {

        const search = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.medicine-row');

        rows.forEach(row => {

            const text = row.textContent.toLowerCase();

            row.style.display = text.includes(search) ? '' : 'none';

        });

    });
</script>

@endsection

