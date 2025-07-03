@extends('layouts.appDashboard')

@section('title', 'Categories List')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories</h3>
            <a href="{{ route('dashboard.addCategory') }}" class="btn btn-primary float-right">Add Category</a>
        </div>
        <div class="card-body table-responsive p-0">
            @if (session('success'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-success w-50 text-center">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('dashboard.updateCategory', $category->id) }}" class="btn btn-sm btn-warning btn-warning mb-1">Edit</a>
                                <form action="{{ route('deleteCategory.destroy', $category->id) }}" method="GET">
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
