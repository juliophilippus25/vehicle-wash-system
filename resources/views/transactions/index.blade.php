@extends('layouts.app')

@section('title', 'Transactions')

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
                        <th class="col-md-3">Transaction Code</th>
                        <th class="col-md-4">Customer Name</th>
                        <th class="col-md-3">Vehicle Type</th>
                        <th class="col-md-2">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_code }}</td>
                            <td>{{ $transaction->customer->name }} / {{ $transaction->customer->phone }}</td>
                            <td>{{ $transaction->vehicle_type->name }}</td>
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
                            <td colspan="4">
                                <strong class="text-dark">
                                    <center>No data available.</center>
                                </strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $transactions->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
