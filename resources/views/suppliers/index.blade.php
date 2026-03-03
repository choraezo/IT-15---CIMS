@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">All <span>Suppliers</span></div>
        <div style="color:var(--muted);font-size:0.875rem;margin-top:0.25rem;">{{ $suppliers->total() }} total suppliers</div>
    </div>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">+ New Supplier</a>
</div>

<div class="card">
    @if($suppliers->count())
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Supplier Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Products</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td><span style="font-family:'Montserrat',sans-serif;font-weight:700;color:var(--accent);">{{ $supplier->supplier_code }}</span></td>
                <td style="font-weight:600;">{{ $supplier->supplier_name }}</td>
                <td style="color:var(--muted);font-size:0.85rem;">{{ $supplier->contact_email }}</td>
                <td style="color:var(--muted);font-size:0.85rem;">{{ $supplier->contact_number }}</td>
                <td><span class="badge badge-green">{{ $supplier->products_count }} products</span></td>
                <td>
                    <div class="actions">
                        <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-secondary btn-sm">View</a>
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Delete this supplier?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:1rem 1.25rem;">{{ $suppliers->links() }}</div>
    @else
    <div class="empty-state">
        <h3>No suppliers yet</h3>
        <p>Add your first supplier to get started.</p><br>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">+ Add Supplier</a>
    </div>
    @endif
</div>
@endsection
