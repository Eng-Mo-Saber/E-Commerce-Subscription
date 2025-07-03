 @extends('layouts.appDashboard')

 @section('title', 'Add User&Admin')
 @section('title_page', 'Add User&Admin')


 @section('content')<div class="card card-primary">
         <div class="card-header">
             <h3 class="card-title">Add New User&Admin</h3>
         </div>
         <form action="{{ route('AddAdmin.store') }}" method="POST" enctype="multipart/form-data">
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
                         placeholder="Enter name">
                 </div>
                 @error('email')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                 </div>
                 @error('phone')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="phone">Phone</label>
                     <input type="text" class="form-control" id="phone" name="phone"
                         placeholder="Enter phone number">
                 </div>
                 @error('address')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="email">address</label>
                     <input type="address" class="form-control" id="address" name="address" placeholder="Enter address">
                 </div> @error('role')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="major_id">Role</label>
                     <select class="form-control" id="role" name="role">

                         <option value="admin">
                             Admin
                         </option>
                         <option value="customer">
                             Customer
                         </option>

                     </select>
                 </div>
                 @error('password')
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             <li>{{ $message }}</li>
                         </ul>
                     </div>
                 @enderror
                 <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" id="password" name="password"
                         placeholder="Enter password">
                 </div>

             </div>

             <div class="card-footer">
                 <button type="submit" class="btn btn-primary">Add User</button>
             </div>
         </form>
     </div>
 @endsection
