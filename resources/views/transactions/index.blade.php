@extends('layouts.app')

@section('title', 'Vehicle Types')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-primary">Manage Transactions</h3>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i>
                Transaction</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="col-md-4">Transaction Code</th>
                        <th class="col-md-4">Customer Name</th>
                        <th class="col-md-2">Price</th>
                        <th class="col-md-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_code }}</td>
                            <td>{{ $transaction->customer->name }}</td>
                            <td>{{ formatIDR($transaction->vehicle_type->price) }}</td>
                        </tr>
                    @empty
                        <tr class="">
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
@endsection
