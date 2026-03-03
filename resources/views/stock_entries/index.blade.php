@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">Stock <span>Entries</span></div>
        <div style="color:var(--muted);font-size:0.875rem;margin-top:0.25rem;">{{ $entries->total() }} total entries</div>
    </div>
    <a href="{{ route('stock_entries.create') }}" class="btn btn-primary">+ New Entry</a>
</div>

<div class="card">
    @if($entries->count())
    <table>
        <thead>
            <tr>
                <th>Delivery Ref</th>
                <th>Product</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $entry)
            <tr>
                <td><span style="font-family:'Montserrat',sans-serif;font-weight:700;color:var(--accent);">{{ $entry->delivery_reference }}</span></td>
                <td>
                    <a href="{{ route('products.show', $entry->product) }}" style="color:var(--text);text-decoration:none;font-weight:600;">
                        {{ $entry->product->product_name }}
                    </a>
                    <div style="font-size:0.75rem;color:var(--muted);">{{ $entry->product->product_code }}</div>
                </td>
                <td>
                    <a href="{{ route('suppliers.show', $entry->supplier) }}" style="color:var(--text);text-decoration:none;font-weight:600;">
                        {{ $entry->supplier->supplier_name }}
                    </a>
                    <div style="font-size:0.75rem;color:var(--muted);">{{ $entry->supplier->supplier_code }}</div>
                </td>
                <td><span class="badge badge-green">+{{ $entry->quantity }} units</span></td>
                <td style="color:var(--muted);font-size:0.85rem;">{{ $entry->created_at->format('M d, Y h:i A') }}</td>
                <td>
                    <form action="{{ route('stock_entries.destroy', $entry) }}" method="POST" onsubmit="return confirm('Delete this entry? Stock will be adjusted.')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:1rem 1.25rem;">{{ $entries->links() }}</div>
    @else
    <div class="empty-state">
        <h3>No stock entries yet</h3>
        <p>Record your first stock delivery.</p><br>
        <a href="{{ route('stock_entries.create') }}" class="btn btn-primary">+ New Entry</a>
    </div>
    @endif
</div>
@endsection
