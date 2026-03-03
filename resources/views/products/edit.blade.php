@extends('layouts.app')

@section('content')
<a href="{{ route('products.show', $product) }}" class="back-link">&#8592; Back to Product</a>

<div class="page-header">
    <div class="page-title">Edit <span>Product</span></div>
</div>

<div class="form-card">
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Product Code</label>
            <input type="text" name="product_code" value="{{ old('product_code', $product->product_code) }}"
                   class="{{ $errors->has('product_code') ? 'is-invalid' : '' }}">
            @error('product_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"
                   class="{{ $errors->has('product_name') ? 'is-invalid' : '' }}">
            @error('product_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Price (&#8369;)</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0.01"
                   class="{{ $errors->has('price') ? 'is-invalid' : '' }}">
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Current Stock</label>
            <input type="number" name="current_stock" value="{{ old('current_stock', $product->current_stock) }}" min="0"
                   class="{{ $errors->has('current_stock') ? 'is-invalid' : '' }}">
            @error('current_stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>

@endsection
