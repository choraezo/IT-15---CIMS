@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">All <span>Products</span></div>
        <div style="color:var(--muted);font-size:0.875rem;margin-top:0.25rem;">{{ $products->total() }} total products</div>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ New Product</a>
</div>

<div class="card">
    @if($products->count())
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Deliveries</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--accent);">{{ $product->product_code }}</span></td>
                <td style="font-weight:500;">{{ $product->product_name }}</td>
                <td>&#8369;{{ number_format($product->price, 2) }}</td>
                <td>
                    @if($product->current_stock <= 0)
                        <span class="badge badge-red">0 units</span>
                    @elseif($product->current_stock < 10)
                        <span class="badge badge-yellow">{{ $product->current_stock }} units</span>
                    @else
                        <span class="badge badge-green">{{ $product->current_stock }} units</span>
                    @endif
                </td>
                <td><span class="badge badge-yellow">{{ $product->stock_entries_count }} entries</span></td>
                <td>
                    <div class="actions">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-secondary btn-sm">View</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:1rem 1.25rem;">{{ $products->links() }}</div>
    @else
    <div class="empty-state">
        <h3>No products yet</h3>
        <p>Start by adding your first product.</p><br>
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add Product</a>
    </div>
    @endif
</div>
@endsection
