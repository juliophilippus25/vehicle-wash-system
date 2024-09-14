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
                        <th class="col-md-3">Customer Name</th>
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
                                <button type="button" class="btn btn-danger btn-sm" title="Delete" data-toggle="modal"
                                    data-target="#modalDelete_{{ $customer->id }}"><i class="ti ti-trash"></i></button>

                                <!-- Modal Delete -->
                                <div class="modal fade" id="modalDelete_{{ $customer->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                {{-- <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5> --}}

                                            </div>
                                            <form method="POST"
                                                action="{{ route('customers.delete', ['id' => $customer->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-alert-circle" width="100"
                                                        height="100" viewBox="0 0 24 24" stroke-width="1" stroke="#2c3e50"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                        <path d="M12 8v4" />
                                                        <path d="M12 16h.01" />
                                                    </svg>
                                                    <h3 class="mt-6">Are you sure delete
                                                        <b>{{ $customer->name }}</b>?
                                                    </h3>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">
                                                        Close</button>
                                                    <button type="submit" class="btn btn-danger"> Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Delete -->
                            </td>
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
