@extends('layouts.app')

@section('title', 'New Prescription')
@section('page-subtitle', 'Create Prescription')

@section('content')

<style>
    .form-card {
        background: white;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 3px 15px rgba(0,0,0,.06);
        max-width: 1100px;
        margin: auto;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        margin: 5px 0 20px;
        color: #1f2937;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        outline: none;
        box-sizing: border-box;
        font-size: 14px;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, .08);
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .medicine-section {
        margin-top: 30px;
        border-top: 1px solid #e5e7eb;
        padding-top: 25px;
    }

    .medicine-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1.5fr 2fr auto;
        gap: 10px;
        align-items: end;
        margin-bottom: 12px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .remove-btn {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 11px 13px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
    }

    .remove-btn:hover {
        background: #fecaca;
    }

    .add-btn {
        background: #eff6ff;
        color: #2563eb;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        margin-top: 5px;
    }

    .add-btn:hover {
        background: #dbeafe;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .btn {
        padding: 11px 18px;
        border-radius: 9px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
    }

    .btn-primary {
        background: #2563eb;
        color: white;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .error-box {
        background: #fee2e2;
        color: #991b1b;
        padding: 14px;
        border-radius: 9px;
        margin-bottom: 20px;
    }

    @media(max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .medicine-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-card">

    <h2 class="section-title">Prescription Information</h2>

    @if($errors->any())
        <div class="error-box">
            <strong>Please fix the following:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('prescriptions.store') }}"
        method="POST"
    >

        @csrf

        <!-- Prescription Information -->

        <div class="form-grid">

            <!-- Patient -->

            <div class="form-group">
                <label>Patient *</label>

                <select name="patient_id" required>

                    <option value="">
                        Select Patient
                    </option>

                    @foreach($patients as $patient)

                        <option
                            value="{{ $patient->id }}"
                            {{ old('patient_id') == $patient->id ? 'selected' : '' }}
                        >
                            {{ $patient->name }}
                            — {{ $patient->patient_code }}
                        </option>

                    @endforeach

                </select>
            </div>


            <!-- Doctor -->

            <div class="form-group">

                <label>Doctor *</label>

                <select name="doctor_id" required>

                    <option value="">
                        Select Doctor
                    </option>

                    @foreach($doctors as $doctor)

                        <option
                            value="{{ $doctor->id }}"
                            {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}
                        >
                            Dr. {{ $doctor->name }}
                            — {{ $doctor->specialization }}
                        </option>

                    @endforeach

                </select>

            </div>


            <!-- Date -->

            <div class="form-group">

                <label>Prescription Date *</label>

                <input
                    type="date"
                    name="prescription_date"
                    value="{{ old('prescription_date', now()->format('Y-m-d')) }}"
                    required
                >

            </div>


            <!-- Notes -->

            <div class="form-group full">

                <label>Notes</label>

                <textarea
                    name="notes"
                    placeholder="Additional prescription notes..."
                >{{ old('notes') }}</textarea>

            </div>

        </div>


        <!-- Medicines -->

        <div class="medicine-section">

            <h2 class="section-title">
                Prescribed Medicines
            </h2>

            <div id="medicineRows">

                <!-- First medicine row -->

                <div class="medicine-row">

                    <!-- Medicine -->

                    <div class="form-group">

                        <label>Medicine *</label>

                        <select
                            name="medicine_id[]"
                            required
                        >

                            <option value="">
                                Select Medicine
                            </option>

                            @foreach($medicines as $medicine)

                                <option value="{{ $medicine->id }}">

                                    {{ $medicine->name }}

                                    — Stock:
                                    {{ $medicine->quantity }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Quantity -->

                    <div class="form-group">

                        <label>Quantity *</label>

                        <input
                            type="number"
                            name="quantity[]"
                            min="1"
                            value="1"
                            required
                        >

                    </div>


                    <!-- Dosage -->

                    <div class="form-group">

                        <label>Dosage</label>

                        <input
                            type="text"
                            name="dosage[]"
                            placeholder="e.g. 1 tablet"
                        >

                    </div>


                    <!-- Instruction -->

                    <div class="form-group">

                        <label>Instruction</label>

                        <input
                            type="text"
                            name="instruction[]"
                            placeholder="e.g. After meal"
                        >

                    </div>


                    <!-- Remove -->

                    <button
                        type="button"
                        class="remove-btn"
                        onclick="removeMedicine(this)"
                    >
                        Remove
                    </button>

                </div>

            </div>


            <!-- Add Medicine -->

            <button
                type="button"
                class="add-btn"
                onclick="addMedicine()"
            >
                + Add Medicine
            </button>

        </div>


        <!-- Buttons -->

        <div class="actions">

            <a
                href="{{ route('prescriptions.index') }}"
                class="btn btn-secondary"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save Prescription
            </button>

        </div>

    </form>

</div>


<script>

    function addMedicine()
    {
        const container =
            document.getElementById('medicineRows');

        const firstRow =
            container.querySelector('.medicine-row');

        const newRow =
            firstRow.cloneNode(true);


        // Clear inputs

        newRow.querySelectorAll('input').forEach(input => {

            if (input.type === 'number') {

                input.value = 1;

            } else {

                input.value = '';

            }

        });


        // Reset medicine dropdown

        newRow.querySelector('select').value = '';


        // Add new row

        container.appendChild(newRow);
    }


    function removeMedicine(button)
    {
        const rows =
            document.querySelectorAll('.medicine-row');


        if (rows.length > 1) {

            button
                .closest('.medicine-row')
                .remove();

        } else {

            alert(
                'At least one medicine is required.'
            );

        }
    }

</script>

@endsection