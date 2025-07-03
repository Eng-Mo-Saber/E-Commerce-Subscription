@extends('layouts.appDashboard')

@section('title', 'Services List')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Services</h3>
            <a href="{{ route('dashboard.addService') }}" class="btn btn-primary float-right">Add Services</a>
        </div>
        <div class="card-body table-responsive p-0">
            @if (session('error'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-danger w-50 text-center">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
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
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>
                                <a href="{{ route('dashboard.updateService', $service->id) }}" class="btn btn-sm btn-warning btn-warning mb-1">Edit</a>
                                <form action="{{ route('deleteService.destroy', $service->id) }}" method="GET">
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
