@extends('layouts.app')

@section('title', 'Vehicle Types')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-primary">Manage Vehicle Types</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="col-md-2">No</th>
                        <th class="col-md-5">Vehicle Type</th>
                        <th class="col-md-5">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vTypes as $vType)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $vType->name }}</td>
                            <td>{{ formatIDR($vType->price) }}</td>
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
