@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="row">
                {{-- Total Customers --}}
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Total Customers </h5>
                                    <h4 class="fw-semibold mb-3">{{ $totalCustomers }}</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div
                                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-users fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Monthly Earnings --}}
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings</h5>
                                    <h4 class="fw-semibold mb-3">{{ formatIDR($monthlyEarnings['total_earning']) }}</h4>
                                    <p class="fs-3">{{ $monthlyEarnings['month'] }}</p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div
                                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Earnings --}}
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Total Earnings </h5>
                                    <h4 class="fw-semibold mb-3">{{ formatIDR($totalEarnings['total_earning']) }}</h4>
                                    <p class="fs-3">{{ $totalEarnings['year'] }}</p>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div
                                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">

                {{-- Recent Transactions --}}
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Customer Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Transaction Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Price</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentTransactions as $transaction)
                                            <tr>
                                                <td>
                                                    {{ $transaction->customer->name }}
                                                </td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($transaction->created_at)->isoFormat('D MMMM Y') }}
                                                </td>
                                                <td>
                                                    @if ($transaction->price == 0)
                                                        Free
                                                    @else
                                                        {{ formatIDR($transaction->price) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="16">
                                                    <strong class="text-dark">
                                                        <center>No data available.</center>
                                                    </strong>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Most Transactions --}}
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Most Transactions</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Customer Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Total Transactions</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Total Price</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mostTransactions as $transaction)
                                            <tr>
                                                <td>
                                                    {{ $transaction->name }}
                                                </td>
                                                <td>
                                                    {{ $transaction->transaction_count }}
                                                </td>
                                                <td>
                                                    {{ formatIDR($transaction->total_price) }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="16">
                                                    <strong class="text-dark">
                                                        <center>No data available.</center>
                                                    </strong>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
