<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Product::query()->with('category');
        if ($request->filled('category_id')){
            $query->where('category_id', $request->integer('category_id'));
        }

        return view('products.index', [
            'products' => $query->latest()->paginate(12),
            'categories' => Category::query()->get(),
            'selectedCategory' => $request->integer('category_id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create', [
            'categories' => Category::query()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('status', 'Product uspesno dodat.');
    }

    public function edit(Product $product): View{
        return view('products.edit',[
            'product' => $product,
            'categories' => Category::query()->get(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('status', 'Product uspesno izmenjen.');
    }
}
