@extends('layouts.app')

@section('content')
<a href="{{ route('products.index') }}" class="back-link">&#8592; Back to Products</a>

<div class="page-header">
    <div class="page-title">New <span>Stock Entry</span></div>
</div>

<div class="form-card">
    <form action="{{ route('stock_entries.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Product</label>
            <select name="product_id" class="{{ $errors->has('product_id') ? 'is-invalid' : '' }}">
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                    {{ $product->product_name }} ({{ $product->product_code }})
                </option>
                @endforeach
            </select>
            @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Supplier</label>
            <select name="supplier_id" class="{{ $errors->has('supplier_id') ? 'is-invalid' : '' }}">
                <option value="">-- Select Supplier --</option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->supplier_name }} ({{ $supplier->supplier_code }})
                </option>
                @endforeach
            </select>
            @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity') }}" min="1"
                   class="{{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                   placeholder="e.g. 50">
            @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Delivery Reference</label>
            <input type="text" name="delivery_reference" value="{{ old('delivery_reference') }}"
                   class="{{ $errors->has('delivery_reference') ? 'is-invalid' : '' }}"
                   placeholder="e.g. DEL-2026-001">
            @error('delivery_reference') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Record Stock Entry</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
