@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-primary">Manage Customers</h3>
            <a href="{{ route('customers.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i>
                Customer</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="col-md-2">No</th>
                        <th class="col-md-3">Name</th>
                        <th class="col-md-2">Phone</th>
                        <th class="col-md-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td class="text-center">
                                <a href="{{ route('customers.edit', ['id' => $customer->id]) }}" data-toggle="tooltip"
                                    data-original-title="Edit" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <form action="{{ route('customers.delete', ['id' => $customer->id]) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-toggle="tooltip" data-original-title="Delete"
                                        class="btn btn-danger btn-sm" title="Delete">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td colspan="16">
                                <strong class="text-dark">
                                    <center>No available data.</center>
                                </strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
