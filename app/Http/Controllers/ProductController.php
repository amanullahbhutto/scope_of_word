<?php

namespace App\Http\Controllers;


use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
// use \DB;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;//product_categories
use App\Models\Poduct_categories;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        $products = Product::with('categories')->get(); // Eager load category
       
    
        return view('admin.products.show', compact('products'));
    }
    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::select('id', 'name')->get(); // Fetch only id & name
        return view('admin.products.create',compact('categories'));
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'qty' => 'nullable|integer',
            'category_id' => 'required|integer', // Ensure category_id is passed as a single integer
        ]);
    
        $product = new Product($request->except('category_id')); // Exclude category_id from product fields
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
            $product->image = 'products/' . $imageName;
        }
    
        $product->save(); // Save product first to get its ID
    
        // Save category_id in product_categories table
        DB::table('product_categories')->insert([
            'product_id' => $product->id,
            'category_id' => $request->category_id,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Display the specified product
    public function show($id)
    {
        $product = Product::with('categories')->findOrFail($id); // Eager load categories for the product
        return view('admin.products.show_user', compact('product'));
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        $product = Product::with('categories')->findOrFail($id); // Load categories relation
        $categories = Category::all(); // Fetch all categories
    
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update the specified product in the database
    // public function update(Request $request, $id)
    // {

    //     $request->validate([
    //         'name' => 'required',
    //         'description' => 'nullable',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'price' => 'required|numeric',
    //         'qty' => 'nullable|integer',
    //         'category_id' => 'required|integer|exists:categories,id', // Validate category
    //     ]);
    
    //     // Find the product by ID
    //     $product = Product::findOrFail($id);
    
    //     $data = $request->except('image', 'category_id'); // Exclude image & category_id from request
    
    //     if ($request->hasFile('image')) {
    //         // Delete old image if exists
    //         if ($product->image && file_exists(public_path($product->image))) {
    //             unlink(public_path($product->image));
    //         }
    
    //         // Store new image in public/products/
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('products'), $imageName);
    
    //         // Add new image path to update data
    //         $data['image'] = 'products/' . $imageName;
    //     }
    
    //     // Update product data
    //     $product->update($data);
    
    //     // Update category in product_categories table
    //     DB::table('product_categories')
    //         ->where('product_id', $product->id)
    //         ->update(['category_id' => $request->category_id]);
    
    //     return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    // }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'qty' => 'nullable|integer',
            'category_id' => 'required|array', // Allow multiple category IDs
            'category_id.*' => 'integer|exists:categories,id', // Ensure each category ID is valid
        ]);
    
        // Find the product by ID
        $product = Product::findOrFail($id);
    
        $data = $request->except('image', 'category_id'); // Exclude image & category_id from request
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
    
            // Store new image in public/products/
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
    
            // Add new image path to update data
            $data['image'] = 'products/' . $imageName;
        }
    
        // Update product data
        $product->update($data);
    
        // Sync categories in product_categories table
        $product->categories()->sync($request->category_id);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    

    // Remove the specified product from the database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
    
        // Delete the related categories from product_categories table
        DB::table('product_categories')->where('product_id', $product->id)->delete();
    
        // Delete the image from the folder if it exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
    
        // Delete the product from the database
        $product->delete();
    
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
