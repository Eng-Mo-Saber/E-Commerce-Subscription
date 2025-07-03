 @extends('layouts.appDashboard')

 @section('title', 'Add Subscription')
 @section('title_page', 'Add Subscription')


 @section('content')<div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">Add New Subscription</h3>
         </div>
         <form action="{{ route('AddSubscription.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
            @if (session('success'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-success w-50 text-center">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-success w-50 text-center">
                        {{ session('error') }}
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
                         placeholder="Enter Subscription name">
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
                 @error('type')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="type">type of Service</label>
                     <select class="form-control" id="type" name="type">
                         @foreach ($services as $service)
                             <option value="{{ $service->name }}">{{ $service->name }}</option>
                         @endforeach
                     </select>
                 </div>
                 @error('duration_in_days')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="duration_in_days">Duration In Days</label>
                     <select class="form-control" id="duration_in_days" name="duration_in_days">
                             <option value="90">3 Months</option>
                             <option value="180">6 Months</option>
                             <option value="360"> 1 Year</option>
                     </select>
                 </div>
             </div>

             <div class="card-footer">
                 <button type="submit" class="btn btn-primary">Add Subscription</button>
             </div>
         </form>
     </div>
 @endsection
