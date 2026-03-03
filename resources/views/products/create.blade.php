@extends('layouts.app')

@section('content')
<a href="{{ route('products.index') }}" class="back-link">&#8592; Back to Products</a>

<div class="page-header">
    <div class="page-title">New <span>Product</span></div>
</div>

<div class="form-card">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Product Code</label>
            <input type="text" name="product_code" value="{{ old('product_code') }}"
                   class="{{ $errors->has('product_code') ? 'is-invalid' : '' }}"
                   placeholder="e.g. PRD-001">
            @error('product_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="product_name" value="{{ old('product_name') }}"
                   class="{{ $errors->has('product_name') ? 'is-invalid' : '' }}"
                   placeholder="e.g. Bottled Water 500ml">
            @error('product_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Price (&#8369;)</label>
            <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0.01"
                   class="{{ $errors->has('price') ? 'is-invalid' : '' }}"
                   placeholder="0.00">
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Initial Stock (optional)</label>
            <input type="number" name="current_stock" value="{{ old('current_stock', 0) }}" min="0"
                   class="{{ $errors->has('current_stock') ? 'is-invalid' : '' }}">
            @error('current_stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
