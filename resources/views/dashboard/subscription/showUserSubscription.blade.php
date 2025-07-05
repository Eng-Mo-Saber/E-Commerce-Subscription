@extends('layouts.appDashboard')

@section('title', 'User Subscription List')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Subscriptions</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
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
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Subscription Name</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Auto Renew</th>
                        <th>Payment Data</th>
                        <th>Payment invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userSubscriptions as $userSubscription)
                        <tr>
                            <td>{{ $userSubscription->id }}</td>
                            <td>{{ $userSubscription->user->name }}</td>
                            <td>{{ $userSubscription->subscription->name }}</td>
                            <td>{{ $userSubscription->status }}</td>
                            <td>{{ $userSubscription->created_at->format('Y-m-d') }}</td>
                            <td>{{ $userSubscription->end_date }}</td>
                            <td>
                                @if ($userSubscription->auto_renew == 1)
                                    Enable
                                @else
                                    Disable
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-row gap-3">
                                    @foreach ($payments as $payment)
                                        @if ($payment->id == $userSubscription->payment_id)


                                                <div>{{ $payment->type_payment }}</div>
                                        @endif
                                    @endforeach


                                </div>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.showPaymentInvoice', $userSubscription->id) }}"
                                    class="btn btn-sm btn-warning btn-warning mb-1">Show</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
