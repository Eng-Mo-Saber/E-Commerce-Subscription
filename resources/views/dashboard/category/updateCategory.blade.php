 @extends('layouts.appDashboard')

 @section('title', 'update Category')
 @section('title_page', 'update Category')


 @section('content')
     <div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">update Category</h3>
         </div>
         <form action="{{ route('updateCategory.update', $category->id) }}" method="POST" enctype="multipart/form-data">
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
                     <label for="name"> update Category Name</label>
                     <input type="text" class="form-control" id="name" name="name"
                         placeholder="{{ $category->name }}">
                 </div>
             </div>

             <div class="card-footer">
                 <button type="submit" class="btn btn-primary">update Category</button>
             </div>
         </form>
     </div>
 @endsection
