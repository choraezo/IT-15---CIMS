@extends('layouts.app')

@section('content')
<a href="{{ route('suppliers.show', $supplier) }}" class="back-link">&#8592; Back to Supplier</a>

<div class="page-header">
    <div class="page-title">Edit <span>Supplier</span></div>
</div>

<div class="form-card">
    <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Supplier Code</label>
            <input type="text" name="supplier_code" value="{{ old('supplier_code', $supplier->supplier_code) }}"
                   class="{{ $errors->has('supplier_code') ? 'is-invalid' : '' }}">
            @error('supplier_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Supplier Name</label>
            <input type="text" name="supplier_name" value="{{ old('supplier_name', $supplier->supplier_name) }}"
                   class="{{ $errors->has('supplier_name') ? 'is-invalid' : '' }}">
            @error('supplier_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Contact Email</label>
            <input type="email" name="contact_email" value="{{ old('contact_email', $supplier->contact_email) }}"
                   class="{{ $errors->has('contact_email') ? 'is-invalid' : '' }}">
            @error('contact_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number', $supplier->contact_number) }}"
                   class="{{ $errors->has('contact_number') ? 'is-invalid' : '' }}">
            @error('contact_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
