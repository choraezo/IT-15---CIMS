@extends('layouts.app')

@section('content')
<a href="{{ route('suppliers.index') }}" class="back-link">&#8592; Back to Suppliers</a>

<div class="page-header">
    <div class="page-title">New <span>Supplier</span></div>
</div>

<div class="form-card">
    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Supplier Code</label>
            <input type="text" name="supplier_code" value="{{ old('supplier_code') }}"
                   class="{{ $errors->has('supplier_code') ? 'is-invalid' : '' }}"
                   placeholder="e.g. SUP-001">
            @error('supplier_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Supplier Name</label>
            <input type="text" name="supplier_name" value="{{ old('supplier_name') }}"
                   class="{{ $errors->has('supplier_name') ? 'is-invalid' : '' }}"
                   placeholder="e.g. ABC Trading Co.">
            @error('supplier_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Contact Email</label>
            <input type="email" name="contact_email" value="{{ old('contact_email') }}"
                   class="{{ $errors->has('contact_email') ? 'is-invalid' : '' }}"
                   placeholder="supplier@email.com">
            @error('contact_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number') }}"
                   class="{{ $errors->has('contact_number') ? 'is-invalid' : '' }}"
                   placeholder="09XX-XXX-XXXX">
            @error('contact_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Add Supplier</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
