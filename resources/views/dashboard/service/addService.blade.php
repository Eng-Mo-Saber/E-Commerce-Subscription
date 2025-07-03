 @extends('layouts.appDashboard')

 @section('title', 'Add service')
 @section('title_page', 'Add service')


 @section('content')
     <div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">Add New Services</h3>
         </div>
         <form action="{{ route('AddService.store') }}" method="POST" enctype="multipart/form-data">
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
                     <label for="name">Service Name</label>
                     <input type="text" class="form-control" id="name" name="name"
                         placeholder="Enter Service name">
                 </div>
             </div>

             <div class="card-footer">
                 <button type="submit" class="btn btn-primary">Add Service</button>
             </div>
         </form>
     </div>
 @endsection
