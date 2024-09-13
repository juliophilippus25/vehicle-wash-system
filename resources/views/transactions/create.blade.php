@extends('layouts.app')

@section('title', 'Trsanctions')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-primary">Create Transaction</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="transaction_code" class="form-label">Transaction Code <b style="color:Tomato;">*</b></label>
                    <input type="text" class="form-control @error('transaction_code') is-invalid @enderror"
                        name="transaction_code" id="transaction_code" value="{{ $transactionCode }}" readonly>
                    @error('transaction_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer" class="form-label">Customer Name <b style="color:Tomato;">*</b></label>
                    <select class="form-select" aria-label="Default select example" name="customer_id" id="customer_id">
                        <option hidden disabled selected value>Select a customer name</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->name }} / {{ $customer->phone }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger"></span>
                </div>
                <div class="mb-3">
                    <label for="vehicle_type" class="form-label">Vehicle Type <b style="color:Tomato;">*</b></label>
                    <select class="form-select" aria-label="Default select example" name="vehicle_type_id"
                        id="vehicle_type_id">
                        <option hidden disabled selected value>Select a vehicle type</option>
                        @foreach ($vTypes as $vType)
                            <option value="{{ $vType->id }}">
                                {{ $vType->name }} / {{ formatIDR($vType->price) }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger"></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
