@extends('layouts.app')

@section('content')
<a href="{{ route('suppliers.index') }}" class="back-link">&#8592; Back to Suppliers</a>

<div class="page-header">
    <div>
        <div style="font-size:0.7rem;color:var(--accent);font-family:'Montserrat',sans-serif;font-weight:700;letter-spacing:2px;margin-bottom:0.35rem;text-transform:uppercase;">{{ $supplier->supplier_code }}</div>
        <div class="page-title">{{ $supplier->supplier_name }}</div>
        <div style="color:var(--muted);font-size:0.85rem;margin-top:0.35rem;">{{ $supplier->contact_email }} &bull; {{ $supplier->contact_number }}</div>
    </div>
    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-secondary">Edit</a>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-label">Products Supplied</div>
        <div class="stat-value">{{ $products->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Units Delivered</div>
        <div class="stat-value">{{ $products->sum('pivot.quantity') }}</div>
    </div>
</div>

<div class="section-title">Products Supplied</div>
<div class="card">
    @if($products->count())
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Product</th>
                <th>Delivery Ref</th>
                <th>Qty Delivered</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><span style="font-family:'Montserrat',sans-serif;font-weight:700;color:var(--accent);">{{ $product->product_code }}</span></td>
                <td>
                    <a href="{{ route('products.show', $product) }}" style="color:var(--text);text-decoration:none;font-weight:600;">
                        {{ $product->product_name }}
                    </a>
                </td>
                <td><span class="badge badge-yellow">{{ $product->pivot->delivery_reference }}</span></td>
                <td><span class="badge badge-green">+{{ $product->pivot->quantity }} units</span></td>
                <td style="color:var(--muted);font-size:0.85rem;">{{ \Carbon\Carbon::parse($product->pivot->created_at)->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-state">
        <h3>No deliveries yet</h3>
        <p>This supplier has no stock entries recorded.</p>
    </div>
    @endif
</div>
@endsection
