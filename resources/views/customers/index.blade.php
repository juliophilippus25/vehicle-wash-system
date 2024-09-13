@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-primary">Manage Customers</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="col-md-2">No</th>
                        <th class="col-md-4">Name</th>
                        <th class="col-md-5">Phone</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
@endsection
