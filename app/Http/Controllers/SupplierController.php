<?php

namespace App\Http\Controllers;


use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withCount('products')
                        ->orderBy('supplier_name')
                        ->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_code'  => 'required|string|max:50|unique:suppliers,supplier_code',
            'supplier_name'  => 'required|string|max:255',
            'contact_email'  => 'required|email|unique:suppliers,contact_email',
            'contact_number' => 'required|string|max:20',
        ]);

        Supplier::create($validated);

        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier added successfully!');
    }

    public function show(Supplier $supplier)
    {
        $products = $supplier->products()
                        ->withPivot('quantity', 'delivery_reference', 'created_at')
                        ->orderByPivot('created_at', 'desc')
                        ->get();

        return view('suppliers.show', compact('supplier', 'products'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'supplier_code'  => 'required|string|max:50|unique:suppliers,supplier_code,' . $supplier->id,
            'supplier_name'  => 'required|string|max:255',
            'contact_email'  => 'required|email|unique:suppliers,contact_email,' . $supplier->id,
            'contact_number' => 'required|string|max:20',
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.show', $supplier)
                         ->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier deleted.');
    }
}
