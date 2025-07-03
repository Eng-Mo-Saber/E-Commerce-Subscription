 @extends('layouts.appDashboard')

 @section('title', 'Update User&Admin')
 @section('title_page', 'Update User&Admin')


 @section('content')
     <div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">Update User&Admin</h3>
         </div>
         <form action="{{ route('updateAdmin.update', $user->id) }}" method="POST" enctype="multipart/form-data">
             @csrf
             @if (session('success'))
                 <div class="d-flex justify-content-center mt-3">
                     <div class="alert alert-success w-50 text-center">
                         {{ session('success') }}
                     </div>
                 </div>
             @endif
             <div class="card-body">
                 @error('role')
                     <div class="invalid-feedback d-block">
                         {{ $message }}
                     </div>
                 @enderror
                 <div class="form-group mb-3">
                     <label for="role">Role</label>
                     <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                         <option disabled selected> Select Role </option>
                         <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                         <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                     </select>
                 </div>

             </div>


             <div class="card-footer">
                 <button type="submit" class="btn btn-primary">Update Role User</button>
             </div>
         </form>
     </div>
 @endsection
