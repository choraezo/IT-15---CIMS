<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
          $products = Product::withCount('stockEntries')
                       ->orderBy('product_name')
                       ->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'product_code'  => 'required|string|max:50|unique:products,product_code',
        'product_name'  => 'required|string|max:255',
        'price'         => 'required|numeric|min:0.01',
        'current_stock' => 'nullable|integer|min:0',
    ]);

    Product::create($validated);

    return redirect()->route('products.index')
                     ->with('success', 'Product created successfully!');
    }


    public function show(Product $product)
    {
         $suppliers = $product->suppliers()
                         ->withPivot('quantity', 'delivery_reference', 'created_at')
                         ->orderByPivot('created_at', 'desc')
                         ->get();

    $stockHistory = $product->stockEntries()
                            ->with('supplier')
                            ->latest()
                            ->get();

    return view('products.show', compact('product', 'suppliers', 'stockHistory'));
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));

    }


    public function update(Request $request, Product $product)
    {
         $validated = $request->validate([
        'product_code' => 'required|string|max:50|unique:products,product_code,' . $product->id,
        'product_name' => 'required|string|max:255',
        'price'        => 'required|numeric|min:0.01',
    ]);

    $product->update($validated);

    return redirect()->route('products.show', $product)
                     ->with('success', 'Product updated successfully!');
    }


    public function destroy(Product $product)
    {
      $product->delete();
     return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
