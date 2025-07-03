@extends('layouts.appDashboard')

@section('title', 'Users List')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
            <a href="{{ route('dashboard.addAdmin') }}" class="btn btn-primary float-right">Add Users</a>
            @if (session('success'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-success w-50 text-center">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-danger w-50 text-center">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>address</th>
                        <th>role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('dashboard.updateAdmin', $user->id) }}" class="btn btn-sm btn-warning btn-warning mb-1">Edit</a>
                                <form  action="{{ route('DeleteAdmin.destroy', $user->id) }}" method="GET">
                                <button type="submit"class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
