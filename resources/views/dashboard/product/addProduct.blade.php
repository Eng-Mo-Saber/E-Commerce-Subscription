 @extends('layouts.appDashboard')

 @section('title', 'Add Product')
 @section('title_page', 'Add Product')


 @section('content')<div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">Add New Product</h3>
         </div>
         <form action="{{ route('AddProduct.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
            @if (session('success'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-success w-50 text-center">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
             <div class="card-body">
                 @error('name')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control" id="name" name="name"
                         placeholder="Enter product name">
                 </div>
                 @error('description')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="description">Description</label>
                     <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                 </div>
                 @error('price')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="Price">Price</label>
                     <input type="Price" class="form-control" id="Price" name="price" placeholder="Enter Price">
                 </div>
                 @error('author')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="Text">Author</label>
                     <input type="text" class="form-control" id="author" name="author" placeholder="Enter author">
                 </div>
                 @error('stock_quantity')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="Text">stock_quantity</label>
                     <input type="text" class="form-control" id="stock_quantity" name="stock_quantity"
                         placeholder="Enter stock_quantity">
                 </div>
                 @error('publisher_year')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="publisher_year">publisher year</label>
                     <input type="number" class="form-control" id="publisher_year" name="publisher_year"
                         placeholder="Enter publisher year" min="1900" max="{{ date('Y') }}">
                 </div>
                 @error('category_id')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="category_id">category</label>
                     <select class="form-control" id="category_id" name="category_id">
                         @foreach ($categories as $category)
                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 @error('image')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="image">Product Image</label>
                     <div class="mb-3 text-end">
                         <input class="form-control" type="file" id="image" name="image" lang="ar">
                     </div>

                 </div>
                 @error('audio_file')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="file">Product Audio File</label>
                     <div class="mb-3 text-end">
                         <input class="form-control" type="file" id="audio" name="audio_file" lang="ar">
                     </div>

                 </div>
                 @error('book_file')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="file">Book File</label>
                     <div class="mb-3 text-end">
                         <input class="form-control" type="file" id="file" name="book_file" lang="ar">
                     </div>

                 </div>
             </div>

             <div class="card-footer">
                 <button type="submit" class="btn btn-primary">Add Product</button>
             </div>
         </form>
     </div>
 @endsection
