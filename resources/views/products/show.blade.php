@extends('layouts.app')

@section('content')
<a href="{{ route('products.index') }}" class="back-link">&#8592; Back to Products</a>

<div class="page-header">
    <div>
        <div style="font-size:0.8rem;color:var(--accent);font-family:'Syne',sans-serif;font-weight:700;letter-spacing:1px;margin-bottom:0.35rem;">{{ $product->product_code }}</div>
        <div class="page-title">{{ $product->product_name }}</div>
    </div>
    <div class="actions">
        <a href="{{ route('stock_entries.create') }}" class="btn btn-primary">+ Stock Entry</a>
        <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Edit</a>
    </div>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-label">Price</div>
        <div class="stat-value">&#8369;{{ number_format($product->price, 2) }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Current Stock</div>
        <div class="stat-value" style="color:{{ $product->current_stock > 0 ? 'var(--success)' : 'var(--danger)' }}">
            {{ $product->current_stock }}
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Suppliers</div>
        <div class="stat-value">{{ $suppliers->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Deliveries</div>
        <div class="stat-value">{{ $stockHistory->count() }}</div>
    </div>
</div>

<div class="section-title">Suppliers That Delivered</div>
<div class="card" style="margin-bottom:2rem;">
    @if($suppliers->count())
    <table>
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Delivery Ref</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>
                    <a href="{{ route('suppliers.show', $supplier) }}" style="color:var(--text);text-decoration:none;font-weight:500;">{{ $supplier->supplier_name }}</a>
                    <div style="font-size:0.78rem;color:var(--muted);">{{ $supplier->supplier_code }}</div>
                </td>
                <td><span class="badge badge-yellow">{{ $supplier->pivot->delivery_reference }}</span></td>
                <td><span class="badge badge-green">+{{ $supplier->pivot->quantity }} units</span></td>
                <td style="color:var(--muted);font-size:0.85rem;">{{ \Carbon\Carbon::parse($supplier->pivot->created_at)->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-state">
        <h3>No deliveries yet</h3>
        <p>No stock entries recorded for this product.</p>
    </div>
    @endif
</div>

<div class="section-title">Full Stock History</div>
<div class="card">
    @if($stockHistory->count())
    <table>
        <thead>
            <tr>
                <th>Delivery Reference</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stockHistory as $entry)
            <tr>
                <td style="font-family:'Syne',sans-serif;font-weight:700;">{{ $entry->delivery_reference }}</td>
                <td>{{ $entry->supplier->supplier_name }}</td>
                <td><span class="badge badge-green">+{{ $entry->quantity }}</span></td>
                <td style="color:var(--muted);font-size:0.85rem;">{{ $entry->created_at->format('M d, Y h:i A') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-state"><h3>No stock history</h3></div>
    @endif
</div>
@endsection
