<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $this->response_success(['Products' => ProductResource::collection($products)]);
    }
    
    /**
     * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => "required|string|max:50",
            'description' => "required|string|max:255",
            'price' => "required|integer",
            'author' => "required|string|max:100",
            'stock_quantity' => "required|integer",
            'publisher_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'category_id' => "required|integer|exists:categories,id",
            'image' => "required|image|mimes:jpeg,png,jpg,gif,svg",
            'audio_file' => "nullable|file|mimes:mp3",
            'book_file' => "nullable|file|mimes:pdf",
        ]);
        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');
            
            // حفظ الملف في storage/app/public/Products-book-file باسم تلقائي
            $path = $file->store('public/Products-book-file');
            
            // نخزن الاسم في الداتابيز بعد إزالة 'public/' عشان نستخدمه مع asset()
            $book_file_path = str_replace('public/Products-book-file/', '', $path);
        }
        $image_path = Storage::disk('public')->put('Products-image', $request->file('image'));
        $audio_path = Storage::disk('public')->put('Products-audio', $request->file('audio_file'));
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'author' => $request->author,
            'stock_quantity' => $request->stock_quantity,
            'publisher_year' => $request->publisher_year,
            'category_id' => $request->category_id,
            'image' => $image_path,
            'audio_file' => $audio_path,
            'book_file' => $book_file_path,
        ]);
        
        return $this->response_success(['Product' => new ProductResource($product)] , "Add Product Successfully");
    }
    
    /**
     * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return $this->response_success(['categories'=>CategoryResource::collection($categories) ,'Product' => new ProductResource($product)]);
    }
    public function showCategories()
    {
        $categories = Category::all();
        return $this->response_success(['categories'=>CategoryResource::collection($categories)]);
    }
    
    /**
     * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => "required|string|max:50",
            'description' => "required|string|max:255",
            'price' => "required|integer",
            'author' => "required|string|max:100",
            'stock_quantity' => "required|integer",
            'publisher_year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'category_id' => "required|integer|exists:categories,id",
            'image' => "nullable|image|mimes:jpeg,png,jpg,gif,svg",
            'audio_file' => "nullable|file|mimes:mp3",
            'book_file' => "nullable|file|mimes:pdf",
        ]);
        
        $product = Product::findOrFail($id);
        
        $image_path = $product->image;
        $audio_path = $product->audio_file;
        $book_file_path =  $product->book_file;
        // تحديث بناءً على اللي المستخدم بعت بس
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->author = $request->author;
        $product->stock_quantity = $request->stock_quantity;
        $product->publisher_year = $request->publisher_year;
        
        // لو فيه رفع صورة جديدة
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put('Products-image', $request->file('image'));
            $product->image = $imagePath;
        }
        
        // لو فيه رفع صوت جديد
        if ($request->hasFile('audio_file')) {
            $audioPath =  Storage::disk('public')->put('Products-audio', $request->file('audio_file'));
            $product->audio_file = $audioPath;
        }
        
        // لو فيه رفع PDF جديد
        if ($request->hasFile('book_file')) {
            $pdfPath = Storage::disk('public')->put('Products-book-file', $request->file('book_file'));
            $product->book_file = $pdfPath;
        }
        
        $product->save();
        return $this->response_success(['Product' => new ProductResource($product)] , "Update Product Successfully");
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // حذف الصورة لو موجودة
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }
        
        // حذف الصوت لو موجود
        if ($product->audio_file) {
            Storage::delete('public/' . $product->audio_file);
        }
        
        // حذف ملف الكتاب PDF لو موجود
        if ($product->book_file) {
            Storage::delete('public/Products-book-file/' . $product->book_file);
        }
        $product->delete();
        return $this->response_success(null , "Delete Product Successfully");
    }
}
