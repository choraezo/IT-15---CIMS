<?php

namespace App\Http\Controllers;


use App\Models\StockEntry;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
class StockEntryController extends Controller
{

    public function index()
    {
         $entries = StockEntry::with(['product', 'supplier'])->latest()->paginate(10);
        return view('stock_entries.index', compact('entries'));
    }

    public function create()
    {
        $products  = Product::all();
        $suppliers = Supplier::all();
        return view('stock_entries.create', compact('products', 'suppliers'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
        'product_id'         => 'required|exists:products,id',
        'supplier_id'        => 'required|exists:suppliers,id',
        'quantity'           => 'required|integer|min:1',
        'delivery_reference' => 'required|string|max:100|unique:stock_entries,delivery_reference',
    ]);

        $entry = StockEntry::create($validated);

         $entry->product->increment('current_stock', $entry->quantity);

        return redirect()->route('products.show', $entry->product_id)
            ->with('success', "Stock entry recorded! +{$entry->quantity} units added.");
    }


    public function show(string $id)
    {

    }


    public function edit(string $id)
    {

    }


    public function update(Request $request, string $id)
    {

    }

    public function destroy(StockEntry $stockEntry)
    {
         $stockEntry->product->decrement('current_stock', $stockEntry->quantity);
         $stockEntry->delete();
         return redirect()->route('stock-entries.index')->with('success', 'Entry removed and stock adjusted.');
    }
}
