@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-primary">Create Customer</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Customer Name <b style="color:Tomato;">*</b></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" placeholder="Enter the customer name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone <b style="color:Tomato;">*</b></label>
                    <input type="text" inputmode="numeric" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" id="phone" placeholder="Enter the phone number customer"
                        onkeypress="return isNumberKey(event)" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@section('script')
    <script>
        // Fungsi ini digunakan untuk kesalahan pada pengguna dalam memasukkan nomor hp, 
        // disini pengguna hanya dapat memasukkan hanya angka tidak dengan huruf maupun simbol atau lain-lainnya
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    </script>
@endsection
@endsection
