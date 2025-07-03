 @extends('layouts.appDashboard')

 @section('title', 'update Service')
 @section('title_page', 'update Service')


 @section('content')
     <div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">update Service</h3>
         </div>
         <form action="{{ route('updateService.update', $service->id) }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="card-body">
                 @error('name')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="name"> update Service Name</label>
                     <input type="text" class="form-control" id="name" name="name"
                         placeholder="{{ $service->name }}">
                 </div>
             </div>

             <div class="card-footer">
                 <button type="submit" class="btn btn-primary">update Service</button>
             </div>
         </form>
     </div>
 @endsection
